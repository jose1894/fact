<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_listap".
 *
 * @property int $id_lista ID UNICO
 * @property string $desc_lista DESCRIPCION TIPO LISTA
 * @property int $estatus_lista ESTATUS TIPO LISTA
 * @property int $sucursal_lista SUCURSAL TIPO LISTA
 *
 * @property ListaPrecios[] $listaPrecios
 */
class TipoListap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_listap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estatus_lista','desc_lista'], 'required'],
            [['estatus_lista', 'sucursal_lista'], 'integer'],
            [['desc_lista'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista' => Yii::t('tipo_listap', 'Id'),
            'desc_lista' => Yii::t('tipo_listap', 'Description'),
            'estatus_lista' => Yii::t('tipo_listap', 'Status'),
            'sucursal_lista' => Yii::t('tipo_listap', 'Sucursal Lista'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListaPrecios()
    {
        return $this->hasMany(ListaPrecios::className(), ['tipo_lista' => 'id_lista']);
    }
}
