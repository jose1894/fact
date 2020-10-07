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

    public function beforeSave($insert)     
    {         
        if (parent::beforeSave($insert)) {             
            if ($this->isNewRecord) {                 
                // if it is new record save the current timestamp as created time                 
                $this->created_by = Yii::$app->user->id;
                $this->created_at = time();            
                return true;
            }                         
        
            // if it is new or update record save that timestamp as updated time            
            $this->updated_at = time();            
            $this->updated_by = Yii::$app->user->id;
            return true;         
        }         

        return false;   
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
