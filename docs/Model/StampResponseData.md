# # StampResponseData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**uuid** | **string** |  | [optional]
**external_ref** | **string** |  | [optional]
**emisor_rfc** | **string** |  | [optional]
**serie** | **string** |  | [optional]
**folio** | **string** |  | [optional]
**total** | **string** |  | [optional]
**fecha_emision** | **string** |  | [optional]
**fecha_timbrado** | **string** |  | [optional]
**sello_sat** | **string** |  | [optional]
**no_certificado_sat** | **string** |  | [optional]
**xml** | **string** | XML timbrado completo. | [optional]
**environment** | **string** | Presente solo en el ambiente demo (timbrado contra sandbox de pruebas). | [optional]
**reconciliation_pending** | **bool** | Presente solo si la persistencia/consumo está pendiente de conciliación; el CFDI es válido. | [optional]
**links** | [**\Facter\Sdk\Model\CfdiLinks**](CfdiLinks.md) |  | [optional]
**timbres** | [**\Facter\Sdk\Model\StampResponseDataTimbres**](StampResponseDataTimbres.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
