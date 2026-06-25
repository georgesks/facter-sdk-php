# Facter\Sdk\CFDIsApi

All URIs are relative to https://demo.facter.com.mx/api/ext/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getCfdi()**](CFDIsApi.md#getCfdi) | **GET** /cfdis/{uuid} | Consultar CFDI |
| [**getCfdiPdf()**](CFDIsApi.md#getCfdiPdf) | **GET** /cfdis/{uuid}/pdf | PDF generado al vuelo |
| [**getCfdiXml()**](CFDIsApi.md#getCfdiXml) | **GET** /cfdis/{uuid}/xml | Descargar XML timbrado |
| [**listCfdis()**](CFDIsApi.md#listCfdis) | **GET** /cfdis | Listar CFDIs |
| [**stampCfdi()**](CFDIsApi.md#stampCfdi) | **POST** /cfdis | Timbrar CFDI |
| [**validateCfdi()**](CFDIsApi.md#validateCfdi) | **POST** /cfdis/validate | Validar sin timbrar (dry-run) |


## `getCfdi()`

```php
getCfdi($uuid): \Facter\Sdk\Model\CfdiDetailResponse
```

Consultar CFDI

Detalle de un CFDI. `404 CFDI_NOT_FOUND` si el UUID no pertenece a un emisor del cliente (no se revela su existencia).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CFDIsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = AAAAAAAA-BBBB-CCCC-DDDD-EEEEEEEEEEEE; // string | UUID (Folio Fiscal) del CFDI.

try {
    $result = $apiInstance->getCfdi($uuid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CFDIsApi->getCfdi: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **string**| UUID (Folio Fiscal) del CFDI. | |

### Return type

[**\Facter\Sdk\Model\CfdiDetailResponse**](../Model/CfdiDetailResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCfdiPdf()`

```php
getCfdiPdf($uuid): \SplFileObject
```

PDF generado al vuelo

PDF generado dinámicamente desde el XML con la plantilla fiscal del emisor (no se persiste).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CFDIsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = AAAAAAAA-BBBB-CCCC-DDDD-EEEEEEEEEEEE; // string | UUID (Folio Fiscal) del CFDI.

try {
    $result = $apiInstance->getCfdiPdf($uuid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CFDIsApi->getCfdiPdf: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **string**| UUID (Folio Fiscal) del CFDI. | |

### Return type

**\SplFileObject**

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/pdf`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getCfdiXml()`

```php
getCfdiXml($uuid): \SplFileObject
```

Descargar XML timbrado

Descarga el XML timbrado del CFDI desde el almacenamiento (Content-Disposition: attachment).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CFDIsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = AAAAAAAA-BBBB-CCCC-DDDD-EEEEEEEEEEEE; // string | UUID (Folio Fiscal) del CFDI.

try {
    $result = $apiInstance->getCfdiXml($uuid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CFDIsApi->getCfdiXml: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **string**| UUID (Folio Fiscal) del CFDI. | |

### Return type

**\SplFileObject**

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/xml`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCfdis()`

```php
listCfdis($emisor_rfc, $fecha_desde, $fecha_hasta, $serie, $folio, $external_ref, $origin, $status, $page, $per_page): \Facter\Sdk\Model\CfdiListResponse
```

Listar CFDIs

Listado paginado de CFDIs de los emisores del cliente. Orden por defecto: `fecha_emision DESC`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CFDIsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$emisor_rfc = EKU9003173C9; // string | Filtra por RFC del emisor.
$fecha_desde = 2026-06-01; // string | Fecha mínima (YYYY-MM-DD) sobre fecha_emision.
$fecha_hasta = 2026-06-30; // string | Fecha máxima (YYYY-MM-DD) sobre fecha_emision.
$serie = A; // string | Filtra por serie.
$folio = 123; // string | Filtra por folio.
$external_ref = REF-FAC-000123; // string | Filtra por referencia del integrador.
$origin = API; // string | Origen del CFDI.
$status = vigente; // string | Estatus del CFDI.
$page = 1; // int | Página (default 1).
$per_page = 25; // int | Resultados por página (default 25, máx 100).

try {
    $result = $apiInstance->listCfdis($emisor_rfc, $fecha_desde, $fecha_hasta, $serie, $folio, $external_ref, $origin, $status, $page, $per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CFDIsApi->listCfdis: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **emisor_rfc** | **string**| Filtra por RFC del emisor. | [optional] |
| **fecha_desde** | **string**| Fecha mínima (YYYY-MM-DD) sobre fecha_emision. | [optional] |
| **fecha_hasta** | **string**| Fecha máxima (YYYY-MM-DD) sobre fecha_emision. | [optional] |
| **serie** | **string**| Filtra por serie. | [optional] |
| **folio** | **string**| Filtra por folio. | [optional] |
| **external_ref** | **string**| Filtra por referencia del integrador. | [optional] |
| **origin** | **string**| Origen del CFDI. | [optional] |
| **status** | **string**| Estatus del CFDI. | [optional] |
| **page** | **int**| Página (default 1). | [optional] |
| **per_page** | **int**| Resultados por página (default 25, máx 100). | [optional] |

### Return type

[**\Facter\Sdk\Model\CfdiListResponse**](../Model/CfdiListResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `stampCfdi()`

```php
stampCfdi($idempotency_key, $stamp_request): \Facter\Sdk\Model\StampResponse
```

Timbrar CFDI

Endpoint principal. Timbra un CFDI 4.0 de tipo **I** (ingreso), **P** (Pagos 2.0) o **E** (Nota de Crédito/Egreso). Consume un timbre del pool del principal **solo si el timbrado es exitoso**.  `emisor_rfc` también puede ser **el RFC de tu propia cuenta principal**: queda registrada automáticamente como emisor (`is_principal: true` en `GET /emisores`) y timbra consumiendo su propio saldo PREPAGO.  **Ambiente demo**: contra `demo.facter.com.mx` el timbrado usa el sandbox de pruebas (sin cobro real) y la respuesta agrega `\"environment\": \"demo\"`. El pipeline es idéntico al de producción (persiste y consume del pool). **Conciliación**: si el PAC timbró pero la persistencia/consumo falló, la respuesta agrega `\"reconciliation_pending\": true`; trátala como exitosa.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CFDIsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$idempotency_key = a3f1c2e4-9b8d-4c7a-8e2f-1d6b5a4c3e2f; // string | UUID único por intento de operación. Reintentar con la MISMA key devuelve el mismo resultado sin volver a ejecutar (ni cobrar) la operación.
$stamp_request = {"emisor_rfc":"EKU9003173C9","external_ref":"REF-FAC-000123","cfdi":{"Version":"4.0","Serie":"A","Folio":"123","FormaPago":"01","MetodoPago":"PUE","SubTotal":"1000.00","Moneda":"MXN","Total":"1160.00","TipoDeComprobante":"I","Exportacion":"01","LugarExpedicion":"64000","Emisor":{"Rfc":"EKU9003173C9","Nombre":"ESCUELA KEMPER URGATE","RegimenFiscal":"601"},"Receptor":{"Rfc":"XAXX010101000","Nombre":"PUBLICO EN GENERAL","DomicilioFiscalReceptor":"64000","RegimenFiscalReceptor":"616","UsoCFDI":"S01"},"Conceptos":[{"ClaveProdServ":"01010101","NoIdentificacion":"SKU-01","Cantidad":"1.000000","ClaveUnidad":"H87","Unidad":"Pieza","Descripcion":"Producto de prueba","ValorUnitario":"1000.00","Importe":"1000.00","ObjetoImp":"02","Impuestos":{"Traslados":[{"Base":"1000.00","Impuesto":"002","TipoFactor":"Tasa","TasaOCuota":"0.160000","Importe":"160.00"}],"Retenciones":[]}}],"Impuestos":{"TotalImpuestosTrasladados":"160.00","Traslados":[{"Base":"1000.00","Impuesto":"002","TipoFactor":"Tasa","TasaOCuota":"0.160000","Importe":"160.00"}]}}}; // \Facter\Sdk\Model\StampRequest

try {
    $result = $apiInstance->stampCfdi($idempotency_key, $stamp_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CFDIsApi->stampCfdi: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **idempotency_key** | **string**| UUID único por intento de operación. Reintentar con la MISMA key devuelve el mismo resultado sin volver a ejecutar (ni cobrar) la operación. | |
| **stamp_request** | [**\Facter\Sdk\Model\StampRequest**](../Model/StampRequest.md)|  | |

### Return type

[**\Facter\Sdk\Model\StampResponse**](../Model/StampResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validateCfdi()`

```php
validateCfdi($stamp_request): \Facter\Sdk\Model\ValidateResponse
```

Validar sin timbrar (dry-run)

Ejecuta TODO el pipeline de validación (estructura, aritmética, catálogos SAT, FiscalValidation, CSD vigente, saldo) **sin sellar ni timbrar**. No consume timbre ni requiere Idempotency-Key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CFDIsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$stamp_request = {"emisor_rfc":"EKU9003173C9","external_ref":"REF-FAC-000123","cfdi":{"Version":"4.0","Serie":"A","Folio":"123","FormaPago":"01","MetodoPago":"PUE","SubTotal":"1000.00","Moneda":"MXN","Total":"1160.00","TipoDeComprobante":"I","Exportacion":"01","LugarExpedicion":"64000","Emisor":{"Rfc":"EKU9003173C9","Nombre":"ESCUELA KEMPER URGATE","RegimenFiscal":"601"},"Receptor":{"Rfc":"XAXX010101000","Nombre":"PUBLICO EN GENERAL","DomicilioFiscalReceptor":"64000","RegimenFiscalReceptor":"616","UsoCFDI":"S01"},"Conceptos":[{"ClaveProdServ":"01010101","NoIdentificacion":"SKU-01","Cantidad":"1.000000","ClaveUnidad":"H87","Unidad":"Pieza","Descripcion":"Producto de prueba","ValorUnitario":"1000.00","Importe":"1000.00","ObjetoImp":"02","Impuestos":{"Traslados":[{"Base":"1000.00","Impuesto":"002","TipoFactor":"Tasa","TasaOCuota":"0.160000","Importe":"160.00"}],"Retenciones":[]}}],"Impuestos":{"TotalImpuestosTrasladados":"160.00","Traslados":[{"Base":"1000.00","Impuesto":"002","TipoFactor":"Tasa","TasaOCuota":"0.160000","Importe":"160.00"}]}}}; // \Facter\Sdk\Model\StampRequest

try {
    $result = $apiInstance->validateCfdi($stamp_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CFDIsApi->validateCfdi: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **stamp_request** | [**\Facter\Sdk\Model\StampRequest**](../Model/StampRequest.md)|  | |

### Return type

[**\Facter\Sdk\Model\ValidateResponse**](../Model/ValidateResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
