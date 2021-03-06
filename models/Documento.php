<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property int $id_doc ID UNICO
 * @property string $cod_doc CODIGO DEL DOCUMENTO
 * @property int $tipo_doc TIPO DE DOCUMENTO: FACTURA, NOTA DE CREDITO, NOTA DE DEBITO
 * @property int $pedido_doc PEDIDO DEL DOCUMENTO
 * @property string $fecha_doc FECHA DEL DOCUMENTO
 * @property string $obsv_doc OBSERVACIONES DEL DOCUMENTO
 * @property string $totalimp_doc TOTAL IMPUESTO DEL DOCUMENTO
 * @property string $totaldsc_doc TOTAL DESCUENTO DEL DOCUMENTO
 * @property string $total_doc TOTAL DEL DOCUMENTO
 * @property int $status_doc ESTADO DEL DOCUMENTO
 * @property int $sucursal_doc SUCURSAL DEL DOCUMENTO
 *
 * @property TipoDocumento $tipoDoc
 * @property Pedido $pedidoDoc
 */
class Documento extends \yii\db\ActiveRecord
{
    const SCENARIO_FACTURA = 'factura';
    const SCENARIO_GUIA = 'guia';
    const FACTURA_DOC = 'FE'; //TIPO DE DOCUMENTO PARA FACTURA
    const GUIA_DOC = 'GR'; //TIPO DE DOCUMENTO PARA GUIAS
    const PROFORMA_DOC = 'PR'; //TIPO DE DOCUMENTO PARA PROFORMAS
    const TIPO_FACTURA = 4; //Tipo de operacion para la tabla transaccion cuando tenga que aumentar o descontar almacen
    const TIPO_PROFORMA = 8; //Tipo de operacion para la tabla transaccion cuando tenga que aumentar o descontar almacen
    const GUIA_GENERADA = 1; // ESTATUS DEL DOCUMENTO
    const DOCUMENTO_GENERADO = 2; //ESTATUS DEL DOCUMENTO
    const DOCUMENTO_ANULADO = 3;
    const MOTIVO_GUIAFACTURA = 1; //MOTICOO DE LA GUIA
    const TIPODOC_FACTURA = 2;
    const TIPODOC_PROFORMA = 7;
    const TIPODOC_BOLETA = 9;
	  const TIPODOC_NCREDITO = 10;
	  const TIPODOC_BNCREDITO = 11;
    const TIPODOC_GUIA = 3;
    const INGRESO_ANULACION = 9; //Tipo de operacion para las anulaciones de facturas y boletas INGRESO POR ANULACION
    const SALIDA_ANULACION = 10; //Tipo de operacion para las anulaciones de notas de credito SALIDA POR ANULACION

    public $cliente;
    public $tipoDocumento;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                // if it is new record save the current timestamp as created time
                $this->created_by = Yii::$app->user->id;
                $this->created_at = time();
                return true;
            }

            // if it is new or update record save that timestamp as updated time
            $this->updated_at = time();
            $this->updated_by = Yii::$app->user->id;
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc','cod_doc'], 'required', 'on' => self::SCENARIO_FACTURA],
            [['tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc','cod_doc','transp_doc','utransp_doc','motivo_doc',], 'required', 'on' => self::SCENARIO_GUIA],
            [['tipo_doc', 'pedido_doc', 'status_doc', 'tipomov_doc','sucursal_doc','numeracion_doc','statussunat_doc'], 'integer'],
            [['fecha_doc','clte_nombre','status_doc','tipo_doc','cliente', 'tipoDocumento'], 'safe'],
            [['obsv_doc','valorr_doc','hash_doc','cliente'], 'string'],
            [['totalimp_doc', 'totaldsc_doc', 'total_doc'], 'number'],
            [['cod_doc'], 'string', 'max' => 10],
            [['valorr_doc','hash_doc'], 'string', 'max' => 255],
            [['tipo_doc'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDocumento::className(), 'targetAttribute' => ['tipo_doc' => 'id_tipod']],
            [['pedido_doc'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_doc' => 'id_pedido']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_doc' => Yii::t('compra', 'Id'),
            'cod_doc' => Yii::t('compra', 'Code'),
            'tipo_doc' => Yii::t('tipo_documento', 'Type'),
            'numeracion_doc' => Yii::t('tipo_documento', 'Serie'),
            'pedido_doc' => Yii::t('pedido', 'Order'),
            'fecha_doc' => Yii::t('documento', 'Date'),
            'obsv_doc' => Yii::t('documento', 'Comments'),
            'totalimp_doc' => Yii::t('documento', 'Tax'),
            'totaldsc_doc' => Yii::t('documento', 'Discount'),
            'total_doc' => Yii::t('documento', 'Total'),
            'transp_doc' => Yii::t('transportista', 'Carrier'),
            'utransp_doc' => Yii::t('unidad_transporte', 'Transport unit'),
            'almacen_doc' => Yii::t('almacen', 'Warehouse'),
            'motivo_doc' => Yii::t('motivo_traslado', 'Transfer reason'),
            'status_doc' => Yii::t('documento', 'Status'),
            'sucursal_doc' => Yii::t('documento', 'Sucursal '),
            'cliente' => Yii::t('cliente', 'Customer'),
            'statussunat_doc' => Yii::t('documento','SUNAT'),
            'tipoDocumento' => Yii::t('tipo_documento', 'Document type'),
            'tipomov_doc' => Yii::t('tipo_movimiento', 'Movement type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDoc()
    {
        return $this->hasOne(TipoDocumento::className(), ['id_tipod' => 'tipo_doc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDoc()
    {
        return $this->hasOne(Pedido::className(), ['id_pedido' => 'pedido_doc'])->joinWith(['cltePedido']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportista()
    {
        return $this->hasOne(Transportista::className(), ['id_transp' => 'transp_doc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadTransporte()
    {
        return $this->hasOne(UnidadTransporte::className(), ['id_utransp' => 'utransp_doc']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotivoTraslado()
    {
        return $this->hasOne(MotivoTraslado::className(), ['id_motivo' => 'motivo_doc']);
    }

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getMotivoNcredito()
    {
        return $this->hasOne(MotivoNcredito::className(), ['cod_motivo' => 'motivosunat_doc']);
    }

    public function getDetalles()
    {
       return $this->hasMany(DocumentoDetalle::className(), ['documento_ddetalle' => 'id_doc']);
    }

    public function getGuiaRem()
    {
       return Documento::find()
           ->where(['pedido_doc' => $this->pedido_doc, 'tipo_doc' => 3])
           ->andWhere(['or',
               ['status_doc' => Documento::GUIA_GENERADA],
               ['status_doc' => Documento::DOCUMENTO_GENERADO],
               ['status_doc' => Documento::DOCUMENTO_ANULADO]
           ]);
    }

	public function getDocAfectado()
	{
		return Documento::find()
			->where([
				'id_doc' => $this->docref_doc,
				// 'status_doc' => Documento::DOCUMENTO_GENERADO
			]);
	}

    public function getNumeracion()
    {
       return $this->hasOne(Numeracion::className(), ['id_num' => 'numeracion_doc']);
    }

    public function getCondPago()
    {
        return $this->hasOne(CondPago::className(),['id_condp' => 'condpago_doc']);
    }

    public function getTipoMovDoc()
    {
        return $this->hasOne(TipoMovimiento::className(),['id_tipom' => 'tipomov_doc']);
    }
}
