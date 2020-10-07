<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_proveedor".
 *
 * @property int $id_tprov
 * @property string $des_tprov
 * @property int $status_tprov
 * @property int $sucursal_tprov
 */
class TipoProveedor extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_proveedor';
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
            [['des_tprov','status_tprov'], 'required'],
            [['status_tprov', 'sucursal_tprov'], 'integer'],
            [['des_tprov'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tprov' => Yii::t('tipo_proveedor', 'Id'),
            'des_tprov' => Yii::t('tipo_proveedor', 'Description'),
            'status_tprov' => Yii::t('tipo_proveedor', 'Status'),
            'sucursal_tprov' => Yii::t('tipo_proveedor', 'Sucursal Tprov'),
        ];
    }

    public static function getTipoProveedor( )
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

        $condicion = ['status_tprov = :status and sucursal_tprov = :sucursal', [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal]];


        $tipoprov = self::find()
            ->select(['id_tprov','des_tprov'])
            ->where($condicion[0], $condicion[1])
            ->orderBy('des_tprov')
            ->all();

        return  ArrayHelper::map( $tipoprov, 'id_tprov', 'des_tprov');
    }
}
