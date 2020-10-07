<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "motivo_ncredito".
 *
 * @property int $id_motivo ID UNICO
 * @property string $cod_motivo CODIGO MOTIVO
 * @property string $des_motivo DESCRIPCION MOTIVO
 * @property int $status_motivo ESTATUS MOTIVO
 * @property int $sucursal_motivo SUCURSAL MOTIVO
 */
class MotivoNcredito extends \yii\db\ActiveRecord
{
	const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motivo_ncredito';
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
            [['cod_motivo', 'des_motivo', 'status_motivo', 'sucursal_motivo'], 'required'],
            [['status_motivo', 'sucursal_motivo'], 'integer'],
            [['cod_motivo'], 'string', 'max' => 2],
            [['des_motivo'], 'string', 'max' => 50],
            [['cod_motivo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_motivo' => Yii::t('motivo_ncredito', 'Id Motivo'),
            'cod_motivo' => Yii::t('motivo_ncredito', 'Cod Motivo'),
            'des_motivo' => Yii::t('motivo_ncredito', 'Des Motivo'),
            'status_motivo' => Yii::t('motivo_ncredito', 'Status Motivo'),
            'sucursal_motivo' => Yii::t('motivo_ncredito', 'Sucursal Motivo'),
        ];
    }
	
	public static function getMotivos( )
    {
		$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condicion = ['status_motivo = :status and sucursal_motivo = :sucursal', [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal]];


      $undTransp = MotivoNcredito::find()
      ->select(['cod_motivo','des_motivo'])
      ->where($condicion[0], $condicion[1])
      ->orderBy('des_motivo')
      ->all();

      return  ArrayHelper::map( $undTransp, 'cod_motivo', 'des_motivo');
    }
}
