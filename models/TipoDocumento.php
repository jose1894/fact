<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_documento".
 *
 * @property int $id_tipod ID UNICO
 * @property string $des_tipod DESCRIPCION TIPO DOCUMENTO
 * @property int $sucursal_tipod SUCURSAL TIPO DOCUMENTO
 * @property int $status_tipod ESTATUS TIPO DOCUMENTO
 *
 * @property Numeracion[] $numeracions
 */
class TipoDocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sucursal_tipod', 'status_tipod'], 'integer'],
            [['des_tipod'], 'string', 'max' => 100],
            [['abrv_tipod'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipod' => Yii::t('tipo_documento', 'Id'),
            'des_tipod' => Yii::t('tipo_documento', 'Description'),
            'sucursal_tipod' => Yii::t('tipo_documento', 'Sucursal'),
            'status_tipod' => Yii::t('tipo_documento', 'Status'),
            'abrv_tipod' => Yii::t('tipo_documento', 'Abbreviation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeracions()
    {
        return $this->hasMany(Numeracion::className(), ['tipo_num' => 'id_tipod']);
    }
}
