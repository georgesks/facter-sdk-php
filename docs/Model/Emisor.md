# # Emisor

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**rfc** | **string** |  | [optional]
**external_ref** | **string** |  | [optional]
**razon_social** | **string** |  | [optional]
**regimen_fiscal** | **string** |  | [optional]
**codigo_postal** | **string** |  | [optional]
**is_principal** | **bool** | true si el emisor es tu propia cuenta principal (registrada automáticamente al activar el API). Consume su propio saldo PREPAGO —la misma bolsa que financia el pool— y no puede desvincularse. | [optional]
**status** | **string** |  | [optional]
**reused** | **bool** | true si se vinculó una cuenta existente con el mismo RFC (respuesta 200); false si se creó un tenant nuevo (respuesta 201). | [optional]
**csd** | [**\Facter\Sdk\Model\EmisorCsd**](EmisorCsd.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
