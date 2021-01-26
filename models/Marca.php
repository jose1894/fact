<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "marca".
 *
 * @property int $id_marca ID UNICO
 * @property string|null $desc_marca DESCRIPCION MARCA
 * @property int|null $status_marca ESTATUS MARCA
 * @property int|null $sucursal_marca SUCURSAL MARCA
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marca';
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
            [['desc_marca', 'status_marca'], 'required'],
            [['status_marca', 'sucursal_marca'], 'integer'],
            [['desc_marca'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_marca' => Yii::t('marca', 'Id'),
            'desc_marca' => Yii::t('marca', 'Description'),
            'status_marca' => Yii::t('marca', 'Status'),
            'sucursal_marca' => Yii::t('marca', 'Sucursal Marca'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['marca_prod' => 'id_marca']);
    }
}
