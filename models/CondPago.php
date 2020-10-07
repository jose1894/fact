<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cond_pago".
 *
 * @property int $id_condp ID UNICO
 * @property string $desc_condp DESCRIP COND PAGO
 * @property int $status_condp ESTATUS CONDICION PAGO
 * @property int $sucursal_condp SUCURSAL COND PAGO
 */
class CondPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cond_pago';
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
            [['desc_condp', 'status_condp'], 'required'],
            [['status_condp', 'sucursal_condp'], 'integer'],
            [['desc_condp'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_condp' => Yii::t('condicionp', 'Id'),
            'desc_condp' => Yii::t('condicionp', 'Description'),
            'status_condp' => Yii::t('condicionp', 'Status'),
            'sucursal_condp' => Yii::t('condicionp', 'Sucursal Condp'),
        ];
    }

    public static function getCondPagoList()
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condiciones = CondPago::find()
                     ->where('status_condp = :status and sucursal_condp = :sucursal',[':status' => 1, ':sucursal' => $sucursal])
                     ->orderBy('desc_condp')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_condp', 'desc_condp');
    }
}
