<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "motivo_traslado".
 *
 * @property int $id_motivo ID UNICO
 * @property string $des_motivo DESCRIPCION MOTIVO
 * @property int $status_motivo ESTATUS MOTIVO
 * @property int $sucursal_motivo SUCURSAL MOTIVO
 */
class MotivoTraslado extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motivo_traslado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_motivo','status_motivo'], 'required'],
            [['status_motivo', 'sucursal_motivo'], 'integer'],
            [['des_motivo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_motivo' => Yii::t('motivo_traslado', 'Id'),
            'des_motivo' => Yii::t('motivo_traslado', 'Description'),
            'status_motivo' => Yii::t('motivo_traslado', 'Status'),
            'sucursal_motivo' => Yii::t('motivo_traslado', 'Sucursal'),
        ];
    }

    public static function getMotivos( )
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condicion = ['status_motivo = :status and sucursal_motivo = :sucursal', [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal]];


      $undTransp = MotivoTraslado::find()
      ->select(['id_motivo','des_motivo'])
      ->where($condicion[0], $condicion[1])
      ->orderBy('des_motivo')
      ->all();

      return  ArrayHelper::map( $undTransp, 'id_motivo', 'des_motivo');
    }
}
