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

    public function init()
    {
      parent::init();
      $this->impuesto_pdetalle = 18;

    }
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
            [['cant_pdetalle', 'precio_pdetalle', 'descu_pdetalle', 'impuesto_pdetalle','plista_pdetalle','total_pdetalle'], 'number'],
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
            'id_pdetalle' => Yii::t('pedido', 'Id'),
            'prod_pdetalle' => Yii::t('pedido', 'Product'),
            'cant_pdetalle' => Yii::t('pedido', 'Quantity'),
            'precio_pdetalle' => Yii::t('pedido', 'Price'),
            'descu_pdetalle' => Yii::t('pedido', 'Discount'),
            'impuesto_pdetalle' => Yii::t('pedido', 'Tax'),
            'status_pdetalle' => Yii::t('pedido', 'Status Pdetalle'),
            'pedido_pdetalle' => Yii::t('pedido', 'Pedido Pdetalle'),
            'plista_pdetalle' => Yii::t('pedido', 'List price'),
            'total_pdetalle' => Yii::t('pedido', 'Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoPdetalle()
    {
        return $this->hasOne(Pedido::className(), ['id_pedido' => 'pedido_pdetalle']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoPdetalle()
    {
        return $this->hasOne(Producto::className(), ['id_prod' => 'prod_pdetalle']);
    }
}
