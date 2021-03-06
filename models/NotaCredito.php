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
class NotaCredito extends \yii\db\ActiveRecord
{
    const SCENARIO_FACTURA   = 'factura';
    const TIPO_NCREDITO      = 7; //Tipo de operacion para la tabla transaccion cuando tenga que aumentar o descontar almacen
    const DOCUMENTO_GENERADO = 2; //ESTATUS DEL DOCUMENTO
    const DOCUMENTO_ANULADO  = 3;
    const MOTIVO_GUIAFACTURA = 1; //MOTIVO DE LA GUIA
    const TIPODOC_NCREDITO   = 10;
    const TIPODOC_BNCREDITO  = 11;
    const NOTA_CREDITO_DOC   = 'NC';
    const REPONER_STOCK      = 1;


    public $cliente;
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
            [['tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc','numeracion_doc','statussunat_doc'], 'integer'],
            [['fecha_doc','clte_nombre'], 'safe'],
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
            'pedido_doc' => Yii::t('pedido', 'Reference doc'),
            'docref_doc' => Yii::t('pedido', 'Order'),
            'fecha_doc' => Yii::t('documento', 'Date'),
            'obsv_doc' => Yii::t('documento', 'Comments'),
            'totalimp_doc' => Yii::t('documento', 'Tax'),
            'totaldsc_doc' => Yii::t('documento', 'Discount'),
            'total_doc' => Yii::t('documento', 'Total'),
            'transp_doc' => Yii::t('transportista', 'Carrier'),
            'utransp_doc' => Yii::t('unidad_transporte', 'Transport unit'),
            'almacen_doc' => Yii::t('almacen', 'Warehouse'),
            'docref_doc' => Yii::t('documento','Referencing document'),
            'motivo_doc' => Yii::t('motivo_traslado', 'Transfer reason'),
            'condpago_doc' => Yii::t('condicionp', 'Payment condition'),
            'status_doc' => Yii::t('documento', 'Status'),
            'sucursal_doc' => Yii::t('documento', 'Sucursal '),
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

    public function getDetalles()
    {
       return $this->hasMany(DocumentoDetalle::className(), ['documento_ddetalle' => 'id_doc']);
    }

    public function getNumeracion()
    {
       return $this->hasOne(Numeracion::className(), ['id_num' => 'numeracion_doc']);
    }

    public function getCondPago()
    {
        return $this->hasOne(CondPago::className(),['id_condp' => 'condpago_doc']);
    }

    public function getDocAfectado()
	{
		return Documento::find()
			->where([
				'id_doc' => $this->docref_doc,
				// 'status_doc' => Documento::DOCUMENTO_GENERADO
			]);
	}
}
