<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compra_detalle".
 *
 * @property int $id_cdetalle ID UNICO
 * @property int $prod_cdetalle PRODUCTO COMPRA DETALLE
 * @property string $cant_cdetalle CANTIDAD COMPRA DETALLE
 * @property string $precio_cdetalle PRECIO COMPRA DETALLE
 * @property string $descu_cdetalle DESCUENTO % COMPRA DETALLE
 * @property string $impuesto_cdetalle IMPUESTO COMPRA DETALLE
 * @property int $status_cdetalle ESTATUS COMPRA DETALLE
 * @property int $compra_cdetalle
 * @property string $plista_cdetalle PRECIO LISTA COMPRA DETALLE
 * @property string $total_cdetalle TOTAL COMPRA DETALLE
 *
 * @property Compra $compraCdetalle
 * @property Producto $prodCdetalle
 */
class CompraDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compra_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_cdetalle'], 'required'],
            [['prod_cdetalle', 'status_cdetalle', 'compra_cdetalle'], 'integer'],
            [['cant_cdetalle', 'precio_cdetalle', 'descu_cdetalle', 'impuesto_cdetalle', 'plista_cdetalle', 'total_cdetalle'], 'number'],
            [['compra_cdetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Compra::className(), 'targetAttribute' => ['compra_cdetalle' => 'id_compra']],
            [['prod_cdetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['prod_cdetalle' => 'id_prod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cdetalle' => Yii::t('compra', 'Id'),
            'prod_cdetalle' => Yii::t('producto', 'Product'),
            'cant_cdetalle' => Yii::t('compra', 'Qtty'),
            'precio_cdetalle' => Yii::t('compra', 'Price'),
            'descu_cdetalle' => Yii::t('compra', 'Disc'),
            'impuesto_cdetalle' => Yii::t('compra', 'Tax'),
            'status_cdetalle' => Yii::t('compra', 'Status'),
            'compra_cdetalle' => Yii::t('compra', 'Compra Cdetalle'),
            'plista_cdetalle' => Yii::t('compra', 'Plista Cdetalle'),
            'total_cdetalle' => Yii::t('compra', 'Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraCdetalle()
    {
        return $this->hasOne(Compra::className(), ['id_compra' => 'compra_cdetalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdCdetalle()
    {
        return $this->hasOne(Producto::className(), ['id_prod' => 'prod_cdetalle']);
    }
}
