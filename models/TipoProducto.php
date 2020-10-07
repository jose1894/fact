<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_producto".
 *
 * @property int $id_tpdcto ID UNICO
 * @property string $desc_tpdcto DESCRIP TIPO PRODUCTO
 * @property int $status_tpdcto ESTATUS TIPO PRODUCTO
 * @property int $sucursal_tpdcto SUCURSAL TIPO PRODUCTO
 *
 * @property Producto[] $productos
 */
class TipoProducto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_producto';
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
            [['desc_tpdcto', 'status_tpdcto'], 'required'],
            [['status_tpdcto', 'sucursal_tpdcto'], 'integer'],
            [['desc_tpdcto'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tpdcto' => Yii::t('tipo_producto', 'Id'),
            'desc_tpdcto' => Yii::t('tipo_producto', 'Description'),
            'status_tpdcto' => Yii::t('tipo_producto', 'Status'),
            'sucursal_tpdcto' => Yii::t('tipo_producto', 'Sucursal Tpdcto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['tipo_pdcto' => 'id_tpdcto']);
    }
}
