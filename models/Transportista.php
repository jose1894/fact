<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transportista';
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
            [['des_transp','status_transp'], 'required'],
            [['status_transp', 'sucursal_transp'], 'integer'],
            [['des_transp'], 'string', 'max' => 150],
            [['ruc_transp'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_transp' => Yii::t('transportista', 'Id'),
            'ruc_transp' => Yii::t('transportista', 'Ruc'),
            'des_transp' => Yii::t('transportista', 'Description'),
            'status_transp' => Yii::t('transportista', 'Status'),
            'sucursal_transp' => Yii::t('transportista', 'Sucursal Transp'),
        ];
    }

    public static function getTransportista( )
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condicion = ['status_transp = :status and sucursal_transp = :sucursal', [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal]];


      $transportista = Transportista::find()
      ->select(['id_transp','des_transp'])
      ->where($condicion[0], $condicion[1])
      ->orderBy('des_transp')
      ->all();

      return  ArrayHelper::map( $transportista, 'id_transp', 'des_transp');
    }
}
