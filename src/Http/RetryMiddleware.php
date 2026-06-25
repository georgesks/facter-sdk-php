<?php

namespace Facter\Sdk\Http;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Middleware de Guzzle que reintenta peticiones de forma segura respetando el
 * contrato de rate-limit del API Externo de Facter.
 *
 * Reintenta SOLO:
 *   - 429 RATE_LIMITED            → respeta el header `Retry-After`.
 *   - 409 IDEMPOTENCY_IN_FLIGHT   → la petición original sigue procesándose;
 *                                   reintentar con la MISMA Idempotency-Key es
 *                                   seguro (el API hace replay, no doble cobro).
 *   - 503 / errores de conexión   → backoff exponencial con jitter.
 *
 * NUNCA reintenta 4xx de negocio (402 sin saldo, 422 validación fiscal, etc.):
 * reintentar no cambiaría el resultado.
 *
 * El SDK generado usa Guzzle; este middleware se monta en su HandlerStack:
 *
 *     $stack = \GuzzleHttp\HandlerStack::create();
 *     $stack->push(RetryMiddleware::create());
 *     $http  = new \GuzzleHttp\Client(['handler' => $stack]);
 *     // ...inyecta $http en la Configuration del SDK.
 *
 * Parte de la CAPA DE ERGONOMÍA escrita a mano (no generada).
 */
final class RetryMiddleware
{
    /** Códigos que ameritan reintento (idempotente y seguro). */
    private const RETRYABLE_STATUS = [409, 429, 503];

    /**
     * @param int   $maxRetries Número máximo de reintentos.
     * @param int   $baseDelayMs Retardo base (ms) para el backoff exponencial.
     * @param int   $maxDelayMs  Tope del retardo (ms).
     */
    public static function create(int $maxRetries = 3, int $baseDelayMs = 500, int $maxDelayMs = 30000): callable
    {
        return \GuzzleHttp\Middleware::retry(
            self::decider($maxRetries),
            self::delay($baseDelayMs, $maxDelayMs)
        );
    }

    private static function decider(int $maxRetries): callable
    {
        return static function (
            int $retries,
            RequestInterface $request,
            ?ResponseInterface $response = null,
            $exception = null
        ) use ($maxRetries): bool {
            if ($retries >= $maxRetries) {
                return false;
            }

            // Error de conexión (timeout, DNS, reset): reintentar.
            if ($exception instanceof \GuzzleHttp\Exception\ConnectException) {
                return true;
            }

            if ($response === null) {
                return false;
            }

            $status = $response->getStatusCode();

            // 409 solo es seguro reintentarlo si trae Idempotency-Key (in-flight).
            if ($status === 409) {
                return $request->hasHeader('Idempotency-Key');
            }

            return in_array($status, self::RETRYABLE_STATUS, true);
        };
    }

    private static function delay(int $baseDelayMs, int $maxDelayMs): callable
    {
        return static function (int $retries, ?ResponseInterface $response = null) use ($baseDelayMs, $maxDelayMs): int {
            // Prioridad 1: el servidor dijo cuánto esperar (Retry-After).
            if ($response !== null && $response->hasHeader('Retry-After')) {
                $retryAfter = trim($response->getHeaderLine('Retry-After'));
                if (is_numeric($retryAfter)) {
                    return min((int) ((float) $retryAfter * 1000), $maxDelayMs);
                }
                // Retry-After como fecha HTTP.
                $ts = strtotime($retryAfter);
                if ($ts !== false) {
                    return (int) min(max(0, $ts - time()) * 1000, $maxDelayMs);
                }
            }

            // Prioridad 2: backoff exponencial con jitter completo.
            $exp    = (int) min($baseDelayMs * (2 ** $retries), $maxDelayMs);
            $jitter = random_int(0, $exp);

            return $jitter;
        };
    }
}
