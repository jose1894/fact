<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property int $id_pais ID UNICO
 * @property string $cod_pais CODIGO PAIS
 * @property string $des_pais DESCIPCION DE PAIS
 * @property int $status_pais ESTATUS PAIS
 * @property int $sucursal_pais SUCURSAL PAIS
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_pais', 'des_pais', 'status_pais'], 'required'],
            [['status_pais', 'sucursal_pais'], 'integer'],
            [['cod_pais'], 'string', 'max' => 3],
            [['des_pais'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pais' => Yii::t('pais', 'Id'),
            'cod_pais' => Yii::t('pais', 'Code'),
            'des_pais' => Yii::t('pais', 'Name'),
            'status_pais' => Yii::t('pais', 'Status'),
            /*'sucursal_pais' => Yii::t('pais', 'Sucursal Pais'),*/
        ];
    }
}
