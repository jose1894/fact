<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_proveedor".
 *
 * @property int $id_tprov
 * @property string $des_tprov
 * @property int $status_tprov
 * @property int $sucursal_tprov
 */
class TipoProveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_tprov','status_tprov'], 'required'],
            [['status_tprov', 'sucursal_tprov'], 'integer'],
            [['des_tprov'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tprov' => Yii::t('tipo_proveedor', 'Id'),
            'des_tprov' => Yii::t('tipo_proveedor', 'Description'),
            'status_tprov' => Yii::t('tipo_proveedor', 'Status'),
            'sucursal_tprov' => Yii::t('tipo_proveedor', 'Sucursal Tprov'),
        ];
    }
}
