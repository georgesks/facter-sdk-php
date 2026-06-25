# Facter\Sdk\WebhooksApi

All URIs are relative to https://demo.facter.com.mx/api/ext/v1, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getWebhooks()**](WebhooksApi.md#getWebhooks) | **GET** /webhooks | Consultar configuración de webhooks |
| [**upsertWebhooks()**](WebhooksApi.md#upsertWebhooks) | **PUT** /webhooks | Configurar webhooks |


## `getWebhooks()`

```php
getWebhooks(): \Facter\Sdk\Model\WebhookConfig
```

Consultar configuración de webhooks

Devuelve la URL y los eventos configurados para los webhooks del cliente.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\WebhooksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getWebhooks();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhooksApi->getWebhooks: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Facter\Sdk\Model\WebhookConfig**](../Model/WebhookConfig.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `upsertWebhooks()`

```php
upsertWebhooks($webhook_config): \Facter\Sdk\Model\WebhookConfig
```

Configurar webhooks

Configura URL y eventos. Cada entrega lleva header `X-Facter-Signature: sha256=<HMAC del cuerpo con webhook_secret>`. Reintentos con backoff: 1m, 5m, 30m, 2h, 12h → DLQ + alerta. Los eventos se disparan tanto para CFDIs timbrados por este API como por la operación web de Facter; `cfdi.timbrado` incluye `origin` (`API` | `WEB`).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: bearerAuth
$config = Facter\Sdk\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Facter\Sdk\Api\WebhooksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$webhook_config = {"url":"https://app.cliente.com/facter/webhook","events":["cfdi.cancelado","cfdi.cancelacion_rechazada","timbres.bajo_saldo","emisor.csd_por_vencer"]}; // \Facter\Sdk\Model\WebhookConfig

try {
    $result = $apiInstance->upsertWebhooks($webhook_config);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WebhooksApi->upsertWebhooks: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **webhook_config** | [**\Facter\Sdk\Model\WebhookConfig**](../Model/WebhookConfig.md)|  | |

### Return type

[**\Facter\Sdk\Model\WebhookConfig**](../Model/WebhookConfig.md)

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
