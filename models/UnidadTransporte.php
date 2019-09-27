<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unidad_transporte".
 *
 * @property int $id_utransp ID UNICO
 * @property string $des_utransp DESCRIPCION UNIDAD TRANSPORTISTA
 * @property int $status_utransp ESTATUS UNIDAD TRANSPORTISTA
 * @property int $sucursal_utransp SUCURSAL UNIDAD TRANSPORTISTA
 */
class UnidadTransporte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidad_transporte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_utransp', 'status_utransp'], 'required'],
            [['status_utransp', 'sucursal_utransp'], 'integer'],
            [['des_utransp'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_utransp' => Yii::t('unidad_transporte', 'Id'),
            'des_utransp' => Yii::t('unidad_transporte', 'Description'),
            'status_utransp' => Yii::t('unidad_transporte', 'Status'),
            'sucursal_utransp' => Yii::t('unidad_transporte', 'Sucursal Utransp'),
        ];
    }
}
