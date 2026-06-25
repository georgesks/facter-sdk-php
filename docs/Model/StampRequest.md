# # StampRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**emisor_rfc** | **string** | RFC de un emisor ACTIVO del cliente con CSD vigente. Debe coincidir con cfdi.Emisor.Rfc. Puede ser el RFC de tu propia cuenta principal (timbra contra su propio saldo PREPAGO). |
**external_ref** | **string** | Referencia del integrador; se devuelve en consultas y webhooks. | [optional]
**fecha_emision** | **string** | Opcional. Si se envía: ventana máx. 72 h hacia atrás, nunca futura (zona horaria por CP). Si es null, la fija Facter al timbrar. | [optional]
**cfdi** | [**\Facter\Sdk\Model\Comprobante**](Comprobante.md) |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
