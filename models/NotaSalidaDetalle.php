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
class NotaSalidaDetalle extends \yii\db\ActiveRecord
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
            [['cant_detalle','costo_detalle'],'number','min'=>1],
            [['trans_detalle'], 'exist', 'skipOnError' => true, 'targetClass' => NotaSalida::className(), 'targetAttribute' => ['trans_detalle' => 'id_trans']],
            [['prod_detalle'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['prod_detalle' => 'id_prod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detalle' => Yii::t('tipo_movimiento', 'Id Detalle'),
            'trans_detalle' => Yii::t('tipo_movimiento', 'Trans Detalle'),
            'prod_detalle' => Yii::t('tipo_movimiento', 'Prod Detalle'),
            'cant_detalle' => Yii::t('tipo_movimiento', 'Cant Detalle'),
            'cant_detalle' => Yii::t('tipo_movimiento', 'Costo Detalle'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransDetalle()
    {
        return $this->hasOne(Transaccion::className(), ['id_trans' => 'trans_detalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdDetalle()
    {
        return $this->hasOne(Producto::className(), ['id_prod' => 'prod_detalle']);
    }
}
