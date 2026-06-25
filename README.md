# OpenAPIClient-php

API pública para timbrar **CFDI 4.0** usando la infraestructura de Facter.

**Modelo comercial:** un **cliente principal** (plan PREPAGO) compra timbres; sus
**emisores** (cada uno un tenant con su propio RFC y CSD) consumen del saldo del principal.

El contrato de entrada es el **JSON canónico CFDI 4.0**: el integrador envía el comprobante
completo (Emisor, Receptor, Conceptos, Impuestos, Complemento...). Facter **valida** consistencia
aritmética y contra catálogos SAT pero **no recalcula** totales — tu sistema es el sistema de registro.

**Ambientes:** prueba en **Demo** `https://demo.facter.com.mx/api/ext/v1` (sandbox de pruebas, sin
cobro real, datos efímeros) y, cuando estés listo, pasa a **Producción** `https://v2.facter.com.mx/api/ext/v1`
(timbrado real, consume timbres). Necesitas **una cuenta y una API key por ambiente**; la key de un
ambiente no funciona en el otro. El host define el comportamiento.

**Autenticación:** `Authorization: Bearer fct_live_xxx`.
**Idempotencia obligatoria** en endpoints mutadores vía header `Idempotency-Key`.
Toda respuesta incluye `X-Request-Id` para soporte.

Documentación completa, quickstart y ejemplos: https://v2.facter.com.mx/developers

For more information, please visit [https://v2.facter.com.mx/developers](https://v2.facter.com.mx/developers).

## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/georgesks/facter-sdk-php.git"
    }
  ],
  "require": {
    "georgesks/facter-sdk-php": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## API Endpoints

All URIs are relative to *https://demo.facter.com.mx/api/ext/v1*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*CFDIsApi* | [**getCfdi**](docs/Api/CFDIsApi.md#getcfdi) | **GET** /cfdis/{uuid} | Consultar CFDI
*CFDIsApi* | [**getCfdiPdf**](docs/Api/CFDIsApi.md#getcfdipdf) | **GET** /cfdis/{uuid}/pdf | PDF generado al vuelo
*CFDIsApi* | [**getCfdiXml**](docs/Api/CFDIsApi.md#getcfdixml) | **GET** /cfdis/{uuid}/xml | Descargar XML timbrado
*CFDIsApi* | [**listCfdis**](docs/Api/CFDIsApi.md#listcfdis) | **GET** /cfdis | Listar CFDIs
*CFDIsApi* | [**stampCfdi**](docs/Api/CFDIsApi.md#stampcfdi) | **POST** /cfdis | Timbrar CFDI
*CFDIsApi* | [**validateCfdi**](docs/Api/CFDIsApi.md#validatecfdi) | **POST** /cfdis/validate | Validar sin timbrar (dry-run)
*CancelacionesApi* | [**getCancellationStatus**](docs/Api/CancelacionesApi.md#getcancellationstatus) | **GET** /cfdis/{uuid}/cancelacion | Estatus de cancelación
*CancelacionesApi* | [**requestCancellation**](docs/Api/CancelacionesApi.md#requestcancellation) | **POST** /cfdis/{uuid}/cancelacion | Solicitar cancelación SAT
*EmisoresApi* | [**createEmisor**](docs/Api/EmisoresApi.md#createemisor) | **POST** /emisores | Dar de alta un emisor
*EmisoresApi* | [**getEmisor**](docs/Api/EmisoresApi.md#getemisor) | **GET** /emisores/{rfc} | Detalle de emisor (incluye estatus CSD)
*EmisoresApi* | [**listEmisores**](docs/Api/EmisoresApi.md#listemisores) | **GET** /emisores | Listar emisores
*EmisoresApi* | [**uploadCsd**](docs/Api/EmisoresApi.md#uploadcsd) | **PUT** /emisores/{rfc}/csd | Subir/reemplazar CSD
*TimbresApi* | [**getTimbres**](docs/Api/TimbresApi.md#gettimbres) | **GET** /timbres | Saldo del pool del principal
*TimbresApi* | [**getTimbresReporte**](docs/Api/TimbresApi.md#gettimbresreporte) | **GET** /timbres/reporte | Reporte de consumo
*WebhooksApi* | [**getWebhooks**](docs/Api/WebhooksApi.md#getwebhooks) | **GET** /webhooks | Consultar configuración de webhooks
*WebhooksApi* | [**upsertWebhooks**](docs/Api/WebhooksApi.md#upsertwebhooks) | **PUT** /webhooks | Configurar webhooks

## Models

- [CancellationRequest](docs/Model/CancellationRequest.md)
- [CancellationStatusResponse](docs/Model/CancellationStatusResponse.md)
- [CancellationStatusResponseData](docs/Model/CancellationStatusResponseData.md)
- [CfdiDetailResponse](docs/Model/CfdiDetailResponse.md)
- [CfdiEmisor](docs/Model/CfdiEmisor.md)
- [CfdiLinks](docs/Model/CfdiLinks.md)
- [CfdiListResponse](docs/Model/CfdiListResponse.md)
- [CfdiListResponseMeta](docs/Model/CfdiListResponseMeta.md)
- [CfdiReceptor](docs/Model/CfdiReceptor.md)
- [CfdiRelacionadoGrupo](docs/Model/CfdiRelacionadoGrupo.md)
- [CfdiRelacionadoGrupoCfdiRelacionadoInner](docs/Model/CfdiRelacionadoGrupoCfdiRelacionadoInner.md)
- [CfdiSummary](docs/Model/CfdiSummary.md)
- [Complemento](docs/Model/Complemento.md)
- [Comprobante](docs/Model/Comprobante.md)
- [Concepto](docs/Model/Concepto.md)
- [CsdUploadRequest](docs/Model/CsdUploadRequest.md)
- [CsdUploadResponse](docs/Model/CsdUploadResponse.md)
- [CsdUploadResponseData](docs/Model/CsdUploadResponseData.md)
- [Emisor](docs/Model/Emisor.md)
- [EmisorCreateRequest](docs/Model/EmisorCreateRequest.md)
- [EmisorCsd](docs/Model/EmisorCsd.md)
- [EmisorResponse](docs/Model/EmisorResponse.md)
- [ErrorEnvelope](docs/Model/ErrorEnvelope.md)
- [ErrorEnvelopeErrorsInner](docs/Model/ErrorEnvelopeErrorsInner.md)
- [ImpuestosComprobante](docs/Model/ImpuestosComprobante.md)
- [ImpuestosConcepto](docs/Model/ImpuestosConcepto.md)
- [InformacionGlobal](docs/Model/InformacionGlobal.md)
- [ListEmisores200Response](docs/Model/ListEmisores200Response.md)
- [Pago20](docs/Model/Pago20.md)
- [Pago20DoctosRelacionadosInner](docs/Model/Pago20DoctosRelacionadosInner.md)
- [Pagos20](docs/Model/Pagos20.md)
- [Pagos20Totales](docs/Model/Pagos20Totales.md)
- [Retencion](docs/Model/Retencion.md)
- [StampRequest](docs/Model/StampRequest.md)
- [StampResponse](docs/Model/StampResponse.md)
- [StampResponseData](docs/Model/StampResponseData.md)
- [StampResponseDataTimbres](docs/Model/StampResponseDataTimbres.md)
- [TimbresResponse](docs/Model/TimbresResponse.md)
- [TimbresResponseData](docs/Model/TimbresResponseData.md)
- [TimbresResponseDataPorEmisorMesActualInner](docs/Model/TimbresResponseDataPorEmisorMesActualInner.md)
- [Traslado](docs/Model/Traslado.md)
- [ValidateResponse](docs/Model/ValidateResponse.md)
- [ValidateResponseData](docs/Model/ValidateResponseData.md)
- [WebhookConfig](docs/Model/WebhookConfig.md)

## Authorization

Authentication schemes defined for the API:
### bearerAuth

- **Type**: Bearer authentication

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

soporte@facter.com.mx

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0.0`
    - Package version: `0.1.0`
    - Generator version: `7.12.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
