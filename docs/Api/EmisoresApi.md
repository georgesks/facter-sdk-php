# Facter\Sdk\EmisoresApi

All URIs are relative to https://demo.facter.com.mx/api/ext/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createEmisor()**](EmisoresApi.md#createEmisor) | **POST** /emisores | Dar de alta un emisor |
| [**getEmisor()**](EmisoresApi.md#getEmisor) | **GET** /emisores/{rfc} | Detalle de emisor (incluye estatus CSD) |
| [**listEmisores()**](EmisoresApi.md#listEmisores) | **GET** /emisores | Listar emisores |
| [**uploadCsd()**](EmisoresApi.md#uploadCsd) | **PUT** /emisores/{rfc}/csd | Subir/reemplazar CSD |


## `createEmisor()`

```php
createEmisor($idempotency_key, $emisor_create_request): \Facter\Sdk\Model\EmisorResponse
```

Dar de alta un emisor

Da de alta un emisor a partir de su RFC. Si el RFC NO existe como cuenta, crea el tenant hijo (branch default, timbrado activo, billing PREPAGO saldo 0). Si el RFC YA existe como una cuenta libre (sin pertenecer a ningún pool ni ser principal/source), reusa esa cuenta sin tocar sus datos fiscales (responde 200 con `reused: true`). En ambos casos la vincula al cliente y la agrega al pool de timbres del principal. Transaccional con rollback total.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\EmisoresApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$idempotency_key = a3f1c2e4-9b8d-4c7a-8e2f-1d6b5a4c3e2f; // string | UUID único por intento de operación. Reintentar con la MISMA key devuelve el mismo resultado sin volver a ejecutar (ni cobrar) la operación.
$emisor_create_request = {"external_ref":"tenant-externo-42","razon_social":"ESCUELA KEMPER URGATE","rfc":"EKU9003173C9","regimen_fiscal":"601","codigo_postal":"64000"}; // \Facter\Sdk\Model\EmisorCreateRequest

try {
    $result = $apiInstance->createEmisor($idempotency_key, $emisor_create_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EmisoresApi->createEmisor: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **idempotency_key** | **string**| UUID único por intento de operación. Reintentar con la MISMA key devuelve el mismo resultado sin volver a ejecutar (ni cobrar) la operación. | |
| **emisor_create_request** | [**\Facter\Sdk\Model\EmisorCreateRequest**](../Model/EmisorCreateRequest.md)|  | |

### Return type

[**\Facter\Sdk\Model\EmisorResponse**](../Model/EmisorResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEmisor()`

```php
getEmisor($rfc): \Facter\Sdk\Model\EmisorResponse
```

Detalle de emisor (incluye estatus CSD)

Detalle del emisor, incluyendo el estatus y vigencia de su CSD.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\EmisoresApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rfc = EKU9003173C9; // string | RFC del emisor (tenant) del cliente.

try {
    $result = $apiInstance->getEmisor($rfc);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EmisoresApi->getEmisor: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rfc** | **string**| RFC del emisor (tenant) del cliente. | |

### Return type

[**\Facter\Sdk\Model\EmisorResponse**](../Model/EmisorResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listEmisores()`

```php
listEmisores(): \Facter\Sdk\Model\ListEmisores200Response
```

Listar emisores

Lista los emisores (tenants) vinculados al cliente del API key. Incluye a tu propia cuenta principal (registrada automáticamente como emisor de su RFC), identificable por `is_principal: true`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\EmisoresApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->listEmisores();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EmisoresApi->listEmisores: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Facter\Sdk\Model\ListEmisores200Response**](../Model/ListEmisores200Response.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `uploadCsd()`

```php
uploadCsd($rfc, $csd_upload_request): \Facter\Sdk\Model\CsdUploadResponse
```

Subir/reemplazar CSD

Carga el CSD del emisor. Validaciones sin excepción: que sea CSD y no FIEL (Key Usage), vigencia, correspondencia cert/key, RFC del certificado = RFC del emisor. Reemplazo atómico (valida antes de tocar el CSD vigente).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\EmisoresApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rfc = EKU9003173C9; // string | RFC del emisor (tenant) del cliente.
$csd_upload_request = {"cer_base64":"MIIF...","key_base64":"MIIE...","password":"••••••••"}; // \Facter\Sdk\Model\CsdUploadRequest

try {
    $result = $apiInstance->uploadCsd($rfc, $csd_upload_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EmisoresApi->uploadCsd: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rfc** | **string**| RFC del emisor (tenant) del cliente. | |
| **csd_upload_request** | [**\Facter\Sdk\Model\CsdUploadRequest**](../Model/CsdUploadRequest.md)|  | |

### Return type

[**\Facter\Sdk\Model\CsdUploadResponse**](../Model/CsdUploadResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
