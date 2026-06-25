<?php

namespace Facter\Sdk;

/**
 * Verificación de firma de webhooks de Facter.
 *
 * Facter firma cada webhook con HMAC-SHA256 del cuerpo CRUDO usando tu
 * `webhook_secret`, y lo envía en el header:
 *
 *     X-Facter-Signature: sha256=<hex>
 *
 * SIEMPRE verifica la firma antes de confiar en el payload: garantiza que el
 * evento viene de Facter y no fue manipulado. Esta clase hace la comparación en
 * tiempo constante (resistente a timing attacks).
 *
 * Parte de la CAPA DE ERGONOMÍA escrita a mano (no generada).
 *
 * Ejemplo:
 *   $raw    = file_get_contents('php://input');
 *   $sigHdr = $_SERVER['HTTP_X_FACTER_SIGNATURE'] ?? '';
 *   if (!Webhook::verifySignature($raw, $sigHdr, $mySecret)) {
 *       http_response_code(401); exit;
 *   }
 *   $event = json_decode($raw, true);
 */
final class Webhook
{
    public const SIGNATURE_HEADER = 'X-Facter-Signature';

    /**
     * Verifica que la firma del header corresponda al cuerpo y al secreto.
     *
     * @param string $rawBody      Cuerpo HTTP CRUDO, sin parsear ni reserializar.
     * @param string $headerValue  Valor del header X-Facter-Signature (con o sin "sha256=").
     * @param string $secret       webhook_secret del cliente.
     */
    public static function verifySignature(string $rawBody, string $headerValue, string $secret): bool
    {
        if ($secret === '' || $headerValue === '') {
            return false;
        }

        $provided = self::stripScheme($headerValue);
        $expected = hash_hmac('sha256', $rawBody, $secret);

        // hash_equals: comparación en tiempo constante.
        return hash_equals($expected, $provided);
    }

    /**
     * Calcula la firma esperada para un cuerpo dado (útil en tests).
     */
    public static function sign(string $rawBody, string $secret): string
    {
        return 'sha256=' . hash_hmac('sha256', $rawBody, $secret);
    }

    private static function stripScheme(string $headerValue): string
    {
        $headerValue = trim($headerValue);
        if (stripos($headerValue, 'sha256=') === 0) {
            return substr($headerValue, 7);
        }

        return $headerValue;
    }
}
