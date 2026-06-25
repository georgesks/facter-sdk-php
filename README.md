# Facter SDK para PHP

[![Packagist](https://img.shields.io/packagist/v/georgesks/facter-sdk-php.svg)](https://packagist.org/packages/georgesks/facter-sdk-php)
[![PHP](https://img.shields.io/packagist/php-v/georgesks/facter-sdk-php.svg)](https://packagist.org/packages/georgesks/facter-sdk-php)
[![License](https://img.shields.io/packagist/l/georgesks/facter-sdk-php.svg)](LICENSE)

SDK oficial en PHP para el **API Externo de Facter**: timbra CFDI 4.0 (Ingreso,
Egreso y Pagos 2.0), administra emisores, consulta tu saldo de timbres y recibe
webhooks — todo con la infraestructura de timbrado de Facter.

📚 **Documentación interactiva del API:** <https://v2.facter.com.mx/developers>

> El SDK se genera desde la especificación OpenAPI oficial. No contiene lógica de
> negocio ni secretos: es un cliente HTTP tipado sobre el contrato público.

---

## Instalación

```bash
composer require georgesks/facter-sdk-php
```

**Requisitos:** PHP 7.4+ u 8.x, extensiones `ext-json` y `ext-curl`. Guzzle se
instala como dependencia.

---

## Ambientes

> **El ambiente es el host.** Una API key de **Demo** solo funciona contra
> `demo.facter.com.mx`; una de **Producción** solo contra `v2.facter.com.mx`. No
> son intercambiables. Empieza siempre en Demo (timbra contra el sandbox del SAT,
> **sin cobro real**).

| Ambiente | Host | Cobro |
|---|---|---|
| `Environment::DEMO` | `demo.facter.com.mx` | No (sandbox) |
| `Environment::LIVE` | `v2.facter.com.mx` | Sí (consume timbres) |

---

## Inicio rápido

```php
<?php
require 'vendor/autoload.php';

use Facter\Sdk\Configuration;
use Facter\Sdk\Environment;
use Facter\Sdk\Api\CFDIsApi;
use Facter\Sdk\Model\StampRequest;
use Facter\Sdk\Idempotency;
use GuzzleHttp\Client;

// 1. Configura tu key y el ambiente (empieza en DEMO).
$config = Configuration::getDefaultConfiguration()
    ->setAccessToken(getenv('FACTER_API_KEY'))          // fct_live_xxx
    ->setHost(Environment::baseUrl(Environment::DEMO));

$cfdis = new CFDIsApi(new Client(), $config);

// 2. Arma el comprobante (JSON canónico CFDI 4.0).
$req = new StampRequest([
    'emisor_rfc'  => 'EKU9003173C9',
    'external_ref'=> 'FACTURA-2026-00042',   // tu folio interno (opcional)
    'cfdi'        => [ /* ...comprobante CFDI 4.0... */ ],
]);

// 3. Timbra. La clave de idempotencia evita doble cobro ante reintentos.
$idempotencyKey = Idempotency::newKey();

try {
    $resp = $cfdis->stampCfdi($idempotencyKey, $req);
    echo "Timbrado UUID: " . $resp->getData()->getUuid() . PHP_EOL;
} catch (\Facter\Sdk\ApiException $e) {
    $error = json_decode($e->getResponseBody(), true);
    fwrite(STDERR, "Error {$e->getCode()}: {$error['error']['code']}\n");
}
```

> La estructura completa del `cfdi` (el JSON canónico CFDI 4.0) está documentada,
> con ejemplos verificados, en el portal: <https://v2.facter.com.mx/developers>.

---

## Idempotencia (timbrar = dinero)

Timbrar consume un timbre. El API exige `Idempotency-Key` en los mutadores para
garantizar consumo **exactamente una vez**. El SDK te da claves seguras:

```php
use Facter\Sdk\Idempotency;

$key = Idempotency::newKey();                          // UUID v4 aleatorio
$key = Idempotency::fromReference('FACTURA-2026-42');  // determinista por folio
```

**Regla:** una clave por intento lógico. Si reintentas el **mismo** CFDI tras un
timeout, **reusa la misma clave** — el API hace *replay* de la respuesta original
en vez de timbrar otra vez.

---

## Reintentos automáticos (respetan `Retry-After`)

Monta el middleware incluido para reintentar de forma segura `429 RATE_LIMITED`,
`409 IDEMPOTENCY_IN_FLIGHT` y errores de red, respetando el header `Retry-After`:

```php
use Facter\Sdk\Http\RetryMiddleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

$stack = HandlerStack::create();
$stack->push(RetryMiddleware::create());          // 3 reintentos por default

$cfdis = new CFDIsApi(new Client(['handler' => $stack]), $config);
```

Nunca reintenta errores de negocio (402 sin saldo, 422 validación) — reintentar
no cambiaría el resultado.

---

## Validar sin timbrar (dry-run)

Verifica estructura, aritmética y catálogos SAT **sin** consumir timbre ni
requerir idempotencia:

```php
$resultado = $cfdis->validateCfdi($req);
```

---

## Webhooks: verifica la firma

Facter firma cada webhook con HMAC-SHA256. **Siempre** verifica antes de confiar
en el payload:

```php
use Facter\Sdk\Webhook;

$raw    = file_get_contents('php://input');
$sigHdr = $_SERVER['HTTP_X_FACTER_SIGNATURE'] ?? '';

if (!Webhook::verifySignature($raw, $sigHdr, getenv('FACTER_WEBHOOK_SECRET'))) {
    http_response_code(401);
    exit;
}

$evento = json_decode($raw, true);   // cfdi.timbrado, cfdi.cancelado, ...
```

---

## Manejo de errores

Toda respuesta de error sigue el envoltorio estándar del API. Las excepciones son
`Facter\Sdk\ApiException`:

```php
try {
    $cfdis->stampCfdi($idempotencyKey, $req);
} catch (\Facter\Sdk\ApiException $e) {
    $body = json_decode($e->getResponseBody(), true);
    // $e->getCode()            → HTTP status (402, 422, 429, ...)
    // $body['error']['code']   → código de negocio (NO_STAMPS_AVAILABLE, ...)
    // $body['error']['docs']   → enlace a la doc del error
}
```

---

## Operaciones disponibles

| Recurso | Clase | Operaciones |
|---|---|---|
| CFDIs | `CFDIsApi` | Timbrar, validar, listar, consultar, XML, PDF |
| Cancelaciones | `CancelacionesApi` | Solicitar y consultar cancelación SAT |
| Emisores | `EmisoresApi` | Alta, listar, detalle, subir CSD |
| Timbres | `TimbresApi` | Saldo del pool, reporte de consumo |
| Webhooks | `WebhooksApi` | Consultar y configurar |

Referencia método por método en [`docs/`](docs/) y en el portal
<https://v2.facter.com.mx/developers>.

---

## Versionado y soporte

- **SemVer.** Cada release acompaña un cambio del contrato del API; el changelog
  de releases es la referencia de cambios.
- **Soporte:** [portal de desarrolladores](https://v2.facter.com.mx/developers) ·
  issues de este repositorio.

## Licencia

[MIT](LICENSE).
