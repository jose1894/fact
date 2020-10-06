<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "almacen".
 *
 * @property int $id_almacen ID UNICO
 * @property string $des_almacen DESCRIPCION ALMACEN
 * @property int $status_almacen ESTATUS ALMACEN
 * @property int $sucursal_almacen SUCURSAL ALMACEN
 */
class Almacen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'almacen';
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
            [['des_almacen', 'status_almacen'], 'required'],
            [['status_almacen', 'sucursal_almacen'], 'integer'],
            [['des_almacen'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_almacen' => Yii::t('almacen', 'Id'),
            'des_almacen' => Yii::t('almacen', 'Description'),
            'status_almacen' => Yii::t('almacen', 'Status'),
            'sucursal_almacen' => Yii::t('almacen', 'Sucursal Almacen'),
        ];
    }

    public static function getAlmacenList()
    {
        $sucursal = Yii::$app->user->identity->profiles->sucursal;

        $almacenes = Almacen::find()
                   ->where('status_almacen = :status and sucursal_almacen = :sucursal', [':status' => 1, ':sucursal' => $sucursal])
                   ->orderBy('des_almacen')
                   ->all();
        return ArrayHelper::map( $almacenes, 'id_almacen', 'des_almacen');
    }
}
