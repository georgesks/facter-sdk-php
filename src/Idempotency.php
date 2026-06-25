<?php

namespace Facter\Sdk;

/**
 * Generación de claves de idempotencia para los mutadores del API (timbrado).
 *
 * El timbrado consume un timbre = dinero. El API exige `Idempotency-Key` en los
 * mutadores para garantizar consumo exactamente-una-vez ante reintentos de red.
 * Esta clase produce claves seguras (≤64 chars, el límite del API) para que el
 * integrador NO tenga que inventarlas a mano y arriesgar un doble cobro.
 *
 * Patrón recomendado: una clave POR INTENTO LÓGICO de timbrado. Si reintentas el
 * mismo CFDI tras un timeout, REUTILIZA la misma clave (el API hace replay de la
 * respuesta original en vez de timbrar otra vez).
 *
 * Parte de la CAPA DE ERGONOMÍA escrita a mano (no generada).
 */
final class Idempotency
{
    /**
     * Genera una clave de idempotencia única (UUID v4, 36 chars).
     */
    public static function newKey(): string
    {
        $data = random_bytes(16);
        // Versión 4 (aleatoria) y variante RFC 4122.
        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Deriva una clave determinista a partir de un identificador de negocio
     * (p.ej. el folio interno del ERP). Útil cuando quieres que el MISMO documento
     * de tu sistema sea idempotente sin guardar la clave aparte. Trunca a 64 chars.
     */
    public static function fromReference(string $reference): string
    {
        return substr('ref_' . hash('sha256', $reference), 0, 64);
    }
}
