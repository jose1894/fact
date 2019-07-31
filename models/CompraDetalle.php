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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cdetalle' => Yii::t('compra', 'Id Cdetalle'),
            'prod_cdetalle' => Yii::t('compra', 'Prod Cdetalle'),
            'cant_cdetalle' => Yii::t('compra', 'Cant Cdetalle'),
            'precio_cdetalle' => Yii::t('compra', 'Precio Cdetalle'),
            'descu_cdetalle' => Yii::t('compra', 'Descu Cdetalle'),
            'impuesto_cdetalle' => Yii::t('compra', 'Impuesto Cdetalle'),
            'status_cdetalle' => Yii::t('compra', 'Status Cdetalle'),
            'compra_cdetalle' => Yii::t('compra', 'Compra Cdetalle'),
            'plista_cdetalle' => Yii::t('compra', 'Plista Cdetalle'),
            'total_cdetalle' => Yii::t('compra', 'Total Cdetalle'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraCdetalle()
    {
        return $this->hasOne(Compra::className(), ['id_compra' => 'compra_cdetalle']);
    }
}
