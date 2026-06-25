# Facter\Sdk\TimbresApi

All URIs are relative to https://demo.facter.com.mx/api/ext/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getTimbres()**](TimbresApi.md#getTimbres) | **GET** /timbres | Saldo del pool del principal |
| [**getTimbresReporte()**](TimbresApi.md#getTimbresReporte) | **GET** /timbres/reporte | Reporte de consumo |


## `getTimbres()`

```php
getTimbres(): \Facter\Sdk\Model\TimbresResponse
```

Saldo del pool del principal

Saldo del pool de timbres del cliente principal y consumo del mes en curso por emisor.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\TimbresApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getTimbres();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimbresApi->getTimbres: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Facter\Sdk\Model\TimbresResponse**](../Model/TimbresResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTimbresReporte()`

```php
getTimbresReporte($desde, $hasta): \Facter\Sdk\Model\TimbresResponse
```

Reporte de consumo

Desglose de consumo por emisor y por día en el periodo. Periodo máximo: 12 meses.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\TimbresApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$desde = 2026-06-01; // string | Fecha inicial (YYYY-MM-DD).
$hasta = 2026-06-30; // string | Fecha final (YYYY-MM-DD).

try {
    $result = $apiInstance->getTimbresReporte($desde, $hasta);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimbresApi->getTimbresReporte: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **desde** | **string**| Fecha inicial (YYYY-MM-DD). | [optional] |
| **hasta** | **string**| Fecha final (YYYY-MM-DD). | [optional] |

### Return type

[**\Facter\Sdk\Model\TimbresResponse**](../Model/TimbresResponse.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
