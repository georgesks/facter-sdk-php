# Facter\Sdk\CancelacionesApi

All URIs are relative to https://demo.facter.com.mx/api/ext/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getCancellationStatus()**](CancelacionesApi.md#getCancellationStatus) | **GET** /cfdis/{uuid}/cancelacion | Estatus de cancelación |
| [**requestCancellation()**](CancelacionesApi.md#requestCancellation) | **POST** /cfdis/{uuid}/cancelacion | Solicitar cancelación SAT |


## `getCancellationStatus()`

```php
getCancellationStatus($uuid): \Facter\Sdk\Model\CancellationStatusResponse
```

Estatus de cancelación

Devuelve el estado actual del flujo de cancelación SAT del CFDI.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CancelacionesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = AAAAAAAA-BBBB-CCCC-DDDD-EEEEEEEEEEEE; // string | UUID (Folio Fiscal) del CFDI.

try {
    $result = $apiInstance->getCancellationStatus($uuid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CancelacionesApi->getCancellationStatus: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **string**| UUID (Folio Fiscal) del CFDI. | |

### Return type

[**\Facter\Sdk\Model\CancellationStatusResponse**](../Model/CancellationStatusResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `requestCancellation()`

```php
requestCancellation($uuid, $idempotency_key, $cancellation_request): \Facter\Sdk\Model\CancellationStatusResponse
```

Solicitar cancelación SAT

Solicita la cancelación ante el SAT. Respuesta `202 Accepted`: el proceso es asíncrono (puede tardar hasta 72 h hábiles con aceptación del receptor). Seguir por GET o webhook `cfdi.cancelado`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\CancelacionesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uuid = AAAAAAAA-BBBB-CCCC-DDDD-EEEEEEEEEEEE; // string | UUID (Folio Fiscal) del CFDI.
$idempotency_key = a3f1c2e4-9b8d-4c7a-8e2f-1d6b5a4c3e2f; // string | UUID único por intento de operación. Reintentar con la MISMA key devuelve el mismo resultado sin volver a ejecutar (ni cobrar) la operación.
$cancellation_request = {"motivo":"02"}; // \Facter\Sdk\Model\CancellationRequest

try {
    $result = $apiInstance->requestCancellation($uuid, $idempotency_key, $cancellation_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CancelacionesApi->requestCancellation: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uuid** | **string**| UUID (Folio Fiscal) del CFDI. | |
| **idempotency_key** | **string**| UUID único por intento de operación. Reintentar con la MISMA key devuelve el mismo resultado sin volver a ejecutar (ni cobrar) la operación. | |
| **cancellation_request** | [**\Facter\Sdk\Model\CancellationRequest**](../Model/CancellationRequest.md)|  | |

### Return type

[**\Facter\Sdk\Model\CancellationStatusResponse**](../Model/CancellationStatusResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
