<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_movimiento".
 *
 * @property int $id_tipom ID UNICO
 * @property string $des_tipom DESCRIPCION TIPO MOVIMIENTO
 * @property int $status_tipom ESTATUS TIPO MOVIMIENTO
 * @property int $sucursal_tipom SUCURSAL TIPO MOVIMIENTO
 */
class TipoMovimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_movimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_tipom'], 'required'],
            [['status_tipom', 'sucursal_tipom'], 'integer'],
            [['des_tipom'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipom' => Yii::t('tipo_movimiento', 'Id'),
            'des_tipom' => Yii::t('tipo_movimiento', 'Description'),
            'status_tipom' => Yii::t('tipo_movimiento', 'Status'),
            'sucursal_tipom' => Yii::t('tipo_movimiento', 'Sucursal Tipom'),
        ];
    }
}
