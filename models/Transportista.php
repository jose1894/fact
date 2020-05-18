<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "transportista".
 *
 * @property int $id_transp ID UNICO
 * @property string $des_transp DESCRIPCION TRANSPORTISTA
 * @property int $status_transp ESTATUS TRANSPORTISTA
 * @property int $sucursal_transp SUCURSAL TRANSPORTISTA
 */
class Transportista extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transportista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_transp','status_transp'], 'required'],
            [['status_transp', 'sucursal_transp'], 'integer'],
            [['des_transp'], 'string', 'max' => 150],
            [['ruc_transp'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_transp' => Yii::t('transportista', 'Id'),
            'ruc_transp' => Yii::t('transportista', 'Ruc'),
            'des_transp' => Yii::t('transportista', 'Description'),
            'status_transp' => Yii::t('transportista', 'Status'),
            'sucursal_transp' => Yii::t('transportista', 'Sucursal Transp'),
        ];
    }

    public static function getTransportista( )
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condicion = ['status_transp = :status and sucursal_transp = :sucursal', [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal]];


      $transportista = Transportista::find()
      ->select(['id_transp','des_transp'])
      ->where($condicion[0], $condicion[1])
      ->orderBy('des_transp')
      ->all();

      return  ArrayHelper::map( $transportista, 'id_transp', 'des_transp');
    }
}
