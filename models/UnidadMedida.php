<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unidad_medida".
 *
 * @property int $id_und ID UNICO
 * @property string $des_und DESCRIPCION UNIDAD MEDIDA
 * @property int $status_und ESTATUS UNIDAD MEDIDA
 * @property int $sucursal_und SUCURSAL UNIDAD MEDIDA
 *
 * @property Producto[] $productos
 */
class UnidadMedida extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidad_medida';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_und', 'status_und'], 'required'],
            [['status_und', 'sucursal_und'], 'integer'],
            [['des_und'], 'string', 'max' => 50],
            [['sunatm_und'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_und' => Yii::t('unidad_medida', 'Id'),
            'des_und' => Yii::t('unidad_medida', 'Description'),
            'sunatm_und' => Yii::t('unidad_medida', 'SUNAT'),
            'status_und' => Yii::t('unidad_medida', 'Status'),
            'sucursal_und' => Yii::t('unidad_medida', 'Sucursal Und'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['umed_prod' => 'id_und']);
    }
}
