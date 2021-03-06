<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_movimiento".
 *
 * @property int $id_tipom ID UNICO
 * @property string $des_tipom DESCRIPCION TIPO MOVIMIENTO
 * @property int $status_tipom ESTATUS TIPO MOVIMIENTO
 * @property int $sucursal_tipom SUCURSAL TIPO MOVIMIENTO
 */
class TipoMovimiento extends \yii\db\ActiveRecord
{

    const TIPO_SALIDA = 'S';
    const TIPO_ENTRADA = 'E';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_movimiento';
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
            [['des_tipom','tipo_tipom','status_tipom'], 'required'],
            [['status_tipom', 'sucursal_tipom'], 'integer'],
            [['des_tipom'], 'string', 'max' => 60],
            [['tipo_tipom'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipom' => Yii::t('tipo_movimiento', 'Id'),
            'des_tipom' => Yii::t('tipo_movimiento', 'Description'),
            'status_tipom' => Yii::t('tipo_movimiento', 'Status'),
            'tipo_tipom' => Yii::t('tipo_movimiento', 'Type'),
            'sucursal_tipom' => Yii::t('tipo_movimiento', 'Sucursal Tipom'),
        ];
    }

    public static function getTipoMovList( $tipo )
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;

      $tipom = TipoMovimiento::find()
                 ->where('status_tipom = :status and sucursal_tipom = :sucursal and tipo_tipom like :tipo ',[':status' => 1, ':sucursal' => $sucursal, ':tipo' => $tipo])
                ->orderBy('des_tipom')
                ->all();
      return  ArrayHelper::map( $tipom, 'id_tipom', 'des_tipom');
    }
}
