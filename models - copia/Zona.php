<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zona".
 *
 * @property int $id_zona ID UNICO
 * @property string $nombre_zona NOMBRE ZONA
 * @property string $desc_zona DESCRIPCION ZONA
 * @property int $estatus_zona ESTATUS ZONA
 * @property int $sucursal_zona SUCURSAL ZONA
 *
 * @property Vendedor[] $vendedors
 */
class Zona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'nombre_zona', 'estatus_zona'], 'required'],
            [['id_zona', 'estatus_zona', 'sucursal_zona'], 'integer'],
            [['desc_zona'], 'string'],
            [['nombre_zona'], 'string', 'max' => 150],
            [['id_zona'], 'unique'],
            [['zona_vend'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_zona' => Yii::t('zona', 'Id'),
            'nombre_zona' => Yii::t('zona', 'Name'),
            'desc_zona' => Yii::t('zona', 'Description'),
            'estatus_zona' => Yii::t('zona', 'Status'),
            'sucursal_zona' => Yii::t('zona', 'Sucursal Zona'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedors()
    {
        return $this->hasMany(Vendedor::className(), ['zona_vend' => 'id_zona']);
    }
}
