<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "series".
 *
 * @property int $id_serie ID SERIE
 * @property string $des_serie DESCRIPCION SERIE
 * @property int $status_serie ESTATUS SERIE
 * @property int $sucursal_serie SUCURSAL SERIE
 */
class Series extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'series';
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
            [['status_serie', 'sucursal_serie'], 'integer'],
            [['des_serie'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_serie' => Yii::t('serie', 'Id'),
            'des_serie' => Yii::t('serie', 'Description'),
            'status_serie' => Yii::t('serie', 'Status'),
            'sucursal_serie' => Yii::t('serie', 'Sucursal Serie'),
        ];
    }
}
