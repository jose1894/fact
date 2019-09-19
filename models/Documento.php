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
    const FACTURA_DOC = 'FE'; //TIPO DE DOCUMENTO
    const TIPO_FACTURA = 4; //Tipo de operacion para la tabla transaccion cuando tenga que aumentar o descontar almacen
    const GUIA_GENERADA = 1;
    const DOCUMENTO_GENERADO = 2;
    const DOCUMENTO_ANULADO = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc','cod_doc'], 'required', 'on' => self::SCENARIO_FACTURA],
            [['tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc'], 'integer'],
            [['fecha_doc'], 'safe'],
            [['obsv_doc'], 'string'],
            [['totalimp_doc', 'totaldsc_doc', 'total_doc'], 'number'],
            [['cod_doc'], 'string', 'max' => 10],
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
            'pedido_doc' => Yii::t('pedido', 'Order'),
            'fecha_doc' => Yii::t('documento', 'Date'),
            'obsv_doc' => Yii::t('documento', 'Comments'),
            'totalimp_doc' => Yii::t('documento', 'Tax'),
            'totaldsc_doc' => Yii::t('documento', 'Discount'),
            'total_doc' => Yii::t('documento', 'Total'),
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
        return $this->hasOne(Pedido::className(), ['id_pedido' => 'pedido_doc']);
    }
}
