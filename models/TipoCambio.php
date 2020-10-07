<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_cambio".
 *
 * @property int $id_tipoc ID UNICO
 * @property string $fecha_tipoc FECHA TIPO CAMBIO
 * @property int $monedac_tipoc MONEDA A CAMBIAR
 * @property int $moneda_tipoc MONEDA CAMBIADA
 * @property int $cambioc_tipoc VALOR COMPRA TIPO CAMBIO
 * @property int $venta_tipoc VALOR DE VENTA TIPO CAMBIO
 * @property int $valorf_tipoc VALOR A FACTURAR
 */
class TipoCambio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_cambio';
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
            [[ 'cambioc_tipoc', 'venta_tipoc', 'valorf_tipoc'], 'required'],
            [['fecha_tipoc'], 'safe'],
            [['monedac_tipoc', 'moneda_tipoc'], 'integer'],
            [['cambioc_tipoc', 'venta_tipoc', 'valorf_tipoc'], 'number', 'min' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipoc' => Yii::t('tipo_cambio', 'Id Tipoc'),
            'fecha_tipoc' => Yii::t('tipo_cambio', 'Date'),
            'monedac_tipoc' => Yii::t('tipo_cambio', 'Monedac Tipoc'),
            'moneda_tipoc' => Yii::t('tipo_cambio', 'Moneda Tipoc'),
            'cambioc_tipoc' => Yii::t('tipo_cambio', 'Change to bill'),
            'venta_tipoc' => Yii::t('tipo_cambio', 'Buy'),
            'valorf_tipoc' => Yii::t('tipo_cambio', 'Sell'),
        ];
    }

    public static function getTipoCambio( $fecha = null )
    {
        if ( empty($fecha) ){
            $fecha = date('Y-m-d' );
        }

        return TipoCambio::find()->where(['fecha_tipoc' => $fecha])->one();
    }
}
