<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "almacen".
 *
 * @property int $id_almacen ID UNICO
 * @property string $des_almacen DESCRIPCION ALMACEN
 * @property int $status_almacen ESTATUS ALMACEN
 * @property int $sucursal_almacen SUCURSAL ALMACEN
 */
class Almacen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'almacen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_almacen', 'status_almacen'], 'required'],
            [['status_almacen', 'sucursal_almacen'], 'integer'],
            [['des_almacen'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_almacen' => Yii::t('almacen', 'Id'),
            'des_almacen' => Yii::t('almacen', 'Description'),
            'status_almacen' => Yii::t('almacen', 'Status'),
            'sucursal_almacen' => Yii::t('almacen', 'Sucursal Almacen'),
        ];
    }

    public static function getAlmacenList()
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $almacenes = Almacen::find()
                   ->where('status_almacen = :status and sucursal_almacen = :sucursal', [':status' => 1, ':sucursal' => $sucursal])
                   ->orderBy('des_almacen')
                   ->all();
      return ArrayHelper::map( $almacenes, 'id_almacen', 'des_almacen');
    }
}
