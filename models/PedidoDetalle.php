<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_detalle".
 *
 * @property int $id_pdetalle ID UNICO
 * @property int $prod_pdetalle PRODUCTO PEDIDO DETALLE
 * @property string $cant_pdetalle CANTIDAD PEDIDO DETALLE
 * @property string $precio_pdetalle PRECIO PEDIDO DETALLE
 * @property string $descu_pdetalle DESCUENTO % PEDIDO DETALLE
 * @property string $impuesto_pdetalle IMPUESTO PEDIDO DETALLE
 * @property int $status_pdetalle ESTATUS PEDIDO DETALLE
 * @property int $pedido_pdetalle
 *
 * @property Pedido $pedidoPdetalle
 */
class PedidoDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_pdetalle','precio_pdetalle','prod_pdetalle','impuesto_pdetalle','cant_pdetalle'], 'required'],
            [['prod_pdetalle', 'status_pdetalle', 'pedido_pdetalle'], 'integer'],
            [['prod_pdetalle'], 'unique', 'targetAttribute' => ['pedido_pdetalle','prod_pdetalle']],
            [['cant_pdetalle', 'precio_pdetalle', 'descu_pdetalle', 'impuesto_pdetalle'], 'number'],
            [['cant_pdetalle','precio_pdetalle'],'number','min' => 1],
             ['cant_pdetalle', 'default', 'value' => 0],
            [['impuesto_pdetalle','descu_pdetalle'],'number','min' => 0],
            [['pedido_pdetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_pdetalle' => 'id_pedido']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pdetalle' => Yii::t('pedido', 'Id Pdetalle'),
            'prod_pdetalle' => Yii::t('pedido', 'Prod Pdetalle'),
            'cant_pdetalle' => Yii::t('pedido', 'Cant Pdetalle'),
            'precio_pdetalle' => Yii::t('pedido', 'Precio Pdetalle'),
            'descu_pdetalle' => Yii::t('pedido', 'Descu Pdetalle'),
            'impuesto_pdetalle' => Yii::t('pedido', 'Impuesto Pdetalle'),
            'status_pdetalle' => Yii::t('pedido', 'Status Pdetalle'),
            'pedido_pdetalle' => Yii::t('pedido', 'Pedido Pdetalle'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoPdetalle()
    {
        return $this->hasOne(Pedido::className(), ['id_pedido' => 'pedido_pdetalle']);
    }
}
