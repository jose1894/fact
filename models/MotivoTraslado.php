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
