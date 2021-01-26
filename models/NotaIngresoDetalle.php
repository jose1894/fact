<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trans_detalle".
 *
 * @property int $id_detalle ID UNICO
 * @property int $trans_detalle TRANSACCION DETALLE
 * @property int $prod_detalle PRODUCTO DETALLE
 * @property int $cant_detalle CANTIDAD DETALLE
 *
 * @property Transaccion $transDetalle
 * @property Producto $prodDetalle
 */
class NotaIngresoDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_detalle', 'cant_detalle'], 'required'],
            [['trans_detalle', 'prod_detalle'], 'integer'],
            [['cant_detalle'],'number','min'=>1],
            [['costo_detalle'],'number'],
            [['trans_detalle'], 'exist', 'skipOnError' => true, 'targetClass' => NotaIngreso::className(), 'targetAttribute' => ['trans_detalle' => 'id_trans']],
            [['prod_detalle'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['prod_detalle' => 'id_prod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detalle' => Yii::t('tipo_movimiento', 'Id'),
            'trans_detalle' => Yii::t('tipo_movimiento', 'Trans Detalle'),
            'prod_detalle' => Yii::t('producto', 'Product'),
            'cant_detalle' => Yii::t('app', 'Quantity'),
            'costo_detalle' => Yii::t('app', 'Cost'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngreso()
    {
        return $this->hasOne(Ingreso::className(), ['id_trans' => 'ingreso_detalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdDetalle()
    {
        return $this->hasOne(Producto::className(), ['id_prod' => 'prod_detalle']);
    }
}
