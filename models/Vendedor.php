<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vendedor".
 *
 * @property int $id_vendedor ID UNICO
 * @property string $dni_vend DNI VENDEDOR
 * @property string $nombre_vend NOMBRE VENDEDOR
 * @property string $tlf_vend TELEFONO VENDEDOR
 * @property int $estatus_vend ESTATUS VENDEDOR
 * @property int $sucursal_vend SUCURSAL VENDEDOR
 * @property int $zona_vend ZONA VENDEDOR
 *
 * @property Cliente[] $clientes
 * @property Zona $zonaVend
 */
class Vendedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendedor';
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
            [[ 'nombre_vend', 'estatus_vend', 'zona_vend'], 'required'],
            [['estatus_vend', 'sucursal_vend'], 'integer'],
            [['zona_vend'],'string'],
            [['dni_vend'], 'string', 'max' => 11],
            [['nombre_vend'], 'string', 'max' => 50],
            [['tlf_vend'], 'string', 'max' => 20],
            [['zona_vend'],'safe'],
            [['zona_vend'], 'exist', 'skipOnError' => true, 'targetClass' => Zona::className(), 'targetAttribute' => ['zona_vend' => 'id_zona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_vendedor' => Yii::t('vendedor', 'Id'),
            'dni_vend' => Yii::t('vendedor', 'Dni'),
            'nombre_vend' => Yii::t('vendedor', 'Name'),
            'tlf_vend' => Yii::t('vendedor', 'Phone'),
            'estatus_vend' => Yii::t('vendedor', 'Status'),
            'sucursal_vend' => Yii::t('vendedor', 'Sucursal Vend'),
            'zona_vend' => Yii::t('vendedor', 'Zone'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['vendedor_clte' => 'id_vendedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonaVend()
    {
        return $this->hasOne(Zona::className(), ['id_zona' => 'zona_vend']);
    }

    public static function getVendedoresList()
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $vendedores = Vendedor::find()
                    ->where('estatus_vend = :status and sucursal_vend = :sucursal',[':status' => 1,':sucursal' => $sucursal])
                    ->orderBy('nombre_vend')
                    ->all();
      return ArrayHelper::map($vendedores,'id_vendedor','nombre_vend');
    }
}
