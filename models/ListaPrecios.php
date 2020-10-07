<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lista_precios".
 *
 * @property int $id_lista ID UNICO
 * @property int $tipo_lista TIPO DE LISTA DE PRECIO
 * @property int $prod_lista PRODUCTO LISTA
 * @property string $precio_lista PRECIO LISTA
 * @property int $sucursal_lista SUCURSAL LISTA
 *
 * @property TipoListap $tipoLista
 * @property Producto $prodLista
 */
class ListaPrecios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lista_precios';
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
            [['tipo_lista', 'prod_lista', 'sucursal_lista'], 'integer'],
            [['precio_lista','preciod_lista','preciom_lista','utilidad1_lista','utilidad2_lista'], 'number'],
            [['prod_lista', 'tipo_lista'], 'unique', 'targetAttribute' => ['prod_lista', 'tipo_lista']],
            [['tipo_lista'], 'exist', 'skipOnError' => true, 'targetClass' => TipoListap::className(), 'targetAttribute' => ['tipo_lista' => 'id_lista']],
            [['prod_lista'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['prod_lista' => 'id_prod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lista' => Yii::t('lista_precios', 'Id'),
            'tipo_lista' => Yii::t('lista_precios', 'List type'),
            'prod_lista' => Yii::t('lista_precios', 'Prod Lista'),
            'precio_lista' => Yii::t('lista_precios', 'List prices'),
            'preciod_lista' => Yii::t('lista_precios','Foreign exchange price'),
            'preciom_lista' => Yii::t('lista_precios','Local currency price'),
            'utilidad1_lista' => Yii::t('lista_precios','Utility 1'),
            'utilidad2_lista' => Yii::t('lista_precios', 'Utility 2'),
            'sucursal_lista' => Yii::t('lista_precios', 'Sucursal Lista'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoLista()
    {
        return $this->hasOne(TipoListap::className(), ['id_lista' => 'tipo_lista']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdLista()
    {
        return $this->hasOne(Producto::className(), ['id_prod' => 'prod_lista']);
    }
}
