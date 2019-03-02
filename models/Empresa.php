<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property int $id_empresa ID UNICO
 * @property string $nombre_empresa NOMBRE EMPRESA
 * @property int $estatus_empresa ESTATUS EMPRESA
 * @property string $dni_empresa DNI EMPRESA
 * @property string $ruc_empresa RUC EMPRESA
 * @property int $tipopers_empresa TIPO PERSONA
 * @property string $tlf_empresa TELEFONO EMPRESA
 * @property string $direcc_empresa DIRECCION EMPRESA
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empresa', 'nombre_empresa', 'estatus_empresa', 'dni_empresa', 'ruc_empresa', 'tipopers_empresa', 'tlf_empresa', 'direcc_empresa'], 'required'],
            [['id_empresa', 'estatus_empresa', 'tipopers_empresa'], 'integer'],
            [['direcc_empresa'], 'string'],
            [['nombre_empresa', 'tlf_empresa'], 'string', 'max' => 150],
            [['dni_empresa'], 'string', 'max' => 20],
            [['ruc_empresa'], 'string', 'max' => 11],
            [['dni_empresa'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_empresa' => Yii::t('app', 'Id Empresa'),
            'nombre_empresa' => Yii::t('app', 'Nombre Empresa'),
            'estatus_empresa' => Yii::t('app', 'Estatus Empresa'),
            'dni_empresa' => Yii::t('app', 'Dni Empresa'),
            'ruc_empresa' => Yii::t('app', 'Ruc Empresa'),
            'tipopers_empresa' => Yii::t('app', 'Tipopers Empresa'),
            'tlf_empresa' => Yii::t('app', 'Tlf Empresa'),
            'direcc_empresa' => Yii::t('app', 'Direcc Empresa'),
        ];
    }
}
