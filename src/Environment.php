<?php

namespace Facter\Sdk;

/**
 * Ambientes del API Externo de Facter.
 *
 * "El ambiente es el modo": el host define el comportamiento. Una API key de Demo
 * SOLO funciona contra demo.facter.com.mx; una de Producción SOLO contra
 * v2.facter.com.mx. No son intercambiables.
 *
 * Esta clase es parte de la CAPA DE ERGONOMÍA escrita a mano (no generada).
 */
final class Environment
{
    public const DEMO = 'demo';
    public const LIVE = 'live';

    public const DEMO_BASE_URL = 'https://demo.facter.com.mx';
    public const LIVE_BASE_URL = 'https://v2.facter.com.mx';

    /** Path base del API externo, común a ambos ambientes. */
    public const API_BASE_PATH = '/api/ext/v1';

    /**
     * Devuelve la URL base completa (host + path del API) para un ambiente.
     *
     * @param string $env Environment::DEMO | Environment::LIVE
     */
    public static function baseUrl(string $env): string
    {
        $host = $env === self::LIVE ? self::LIVE_BASE_URL : self::DEMO_BASE_URL;

        return $host . self::API_BASE_PATH;
    }
}
