<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transportista".
 *
 * @property int $id_transp ID UNICO
 * @property string $des_transp DESCRIPCION TRANSPORTISTA
 * @property int $status_transp ESTATUS TRANSPORTISTA
 * @property int $sucursal_transp SUCURSAL TRANSPORTISTA
 */
class Transportista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transportista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_transp', 'sucursal_transp'], 'integer'],
            [['des_transp'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_transp' => Yii::t('transportista', 'Id Transp'),
            'des_transp' => Yii::t('transportista', 'Des Transp'),
            'status_transp' => Yii::t('transportista', 'Status Transp'),
            'sucursal_transp' => Yii::t('transportista', 'Sucursal Transp'),
        ];
    }
}
