# # Comprobante

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**version** | **string** |  |
**serie** | **string** |  | [optional]
**folio** | **string** |  | [optional]
**forma_pago** | **string** | Catálogo c_FormaPago. Omitir en comprobantes tipo P. | [optional]
**metodo_pago** | **string** | Omitir en comprobantes tipo P. | [optional]
**condiciones_de_pago** | **string** |  | [optional]
**sub_total** | **string** |  |
**descuento** | **string** |  | [optional]
**moneda** | **string** | Catálogo c_Moneda. XXX para comprobantes tipo P. |
**tipo_cambio** | **string** | Requerido cuando Moneda ≠ MXN/XXX. | [optional]
**total** | **string** |  |
**tipo_de_comprobante** | **string** | I&#x3D;Ingreso, E&#x3D;Egreso/NC, P&#x3D;Pago. |
**exportacion** | **string** |  |
**lugar_expedicion** | **string** | Código postal del emisor. |
**emisor** | [**\Facter\Sdk\Model\CfdiEmisor**](CfdiEmisor.md) |  |
**receptor** | [**\Facter\Sdk\Model\CfdiReceptor**](CfdiReceptor.md) |  |
**conceptos** | [**\Facter\Sdk\Model\Concepto[]**](Concepto.md) |  |
**impuestos** | [**\Facter\Sdk\Model\ImpuestosComprobante**](ImpuestosComprobante.md) |  | [optional]
**cfdi_relacionados** | [**\Facter\Sdk\Model\CfdiRelacionadoGrupo[]**](CfdiRelacionadoGrupo.md) | Array de grupos de CFDIs relacionados (uno por TipoRelacion). Requerido en tipo E (Nota de Crédito); null/omitido en los demás. | [optional]
**complemento** | [**\Facter\Sdk\Model\Complemento**](Complemento.md) | Complemento.Pagos requerido en tipo P; null/omitido si no aplica. | [optional]
**informacion_global** | [**\Facter\Sdk\Model\InformacionGlobal**](InformacionGlobal.md) | Factura global (público en general); null/omitido si no aplica. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
