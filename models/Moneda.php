<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "moneda".
 *
 * @property int $id_moneda ID UNICO
 * @property string $des_moneda DESCRIPCION MONEDA
 * @property string $tipo_moneda TIPO MONEDA
 * @property int $status_moneda ESTATUS MONEDA
 * @property int $sucursal_moneda SUCURSAL MONEDA
 */
class Moneda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'moneda';
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
            [['des_moneda', 'status_moneda', 'tipo_moneda'], 'required'],
            [['status_moneda', 'sucursal_moneda'], 'integer'],
            [['des_moneda'], 'string', 'max' => 50],
            [['sunatm_moneda'], 'string', 'max' => 10],
            [['tipo_moneda'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_moneda' => Yii::t('moneda', 'Id'),
            'des_moneda' => Yii::t('moneda', 'Description'),
            'sunatm_moneda' => Yii::t('moneda', 'SUNAT'),
            'tipo_moneda' => Yii::t('moneda', 'Type'),
            'status_moneda' => Yii::t('moneda', 'Status'),
            'sucursal_moneda' => Yii::t('moneda', 'Sucursal Moneda'),
        ];
    }

    public static function getMonedasList( $extr = false, $nac = false)
    {
	  $sucursal = Yii::$app->user->identity->profiles->sucursal;

      if ( !$nac && !$extr ){
        $monedas = Moneda::find()
                   ->where('status_moneda = :status and sucursal_moneda = :sucursal',[':status' => 1, ':sucursal' => $sucursal])
                  ->orderBy('des_moneda')
                  ->all();
        return  ArrayHelper::map( $monedas, 'id_moneda', 'des_moneda');
      } else if ( $nac && !$extr ) {

        $monedas = Moneda::find()
        ->where('status_moneda = :status and sucursal_moneda = :sucursal and tipo_moneda = :tipo',[':status' => 1, ':sucursal' => $sucursal, ':tipo' => 'N'])
        ->orderBy('des_moneda')->all();
        return  ArrayHelper::map( $monedas, 'id_moneda', 'des_moneda');
      }else if ( !$nac && $extr ){
        $monedas = Moneda::find()
        ->where('status_moneda = :status and sucursal_moneda = :sucursal and tipo_moneda = :tipo',[':status' => 1, ':sucursal' => $sucursal, ':tipo' => 'E'])
        ->orderBy('des_moneda')
        ->all();
        return  ArrayHelper::map( $monedas, 'id_moneda', 'des_moneda');
      }
    }
}
