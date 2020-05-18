<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "unidad_transporte".
 *
 * @property int $id_utransp ID UNICO
 * @property string $des_utransp DESCRIPCION UNIDAD TRANSPORTISTA
 * @property int $status_utransp ESTATUS UNIDAD TRANSPORTISTA
 * @property int $sucursal_utransp SUCURSAL UNIDAD TRANSPORTISTA
 */
class UnidadTransporte extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidad_transporte';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_utransp', 'status_utransp'], 'required'],
            [['status_utransp', 'sucursal_utransp'], 'integer'],
            [['des_utransp'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_utransp' => Yii::t('unidad_transporte', 'Id'),
            'des_utransp' => Yii::t('unidad_transporte', 'Description'),
            'status_utransp' => Yii::t('unidad_transporte', 'Status'),
            'sucursal_utransp' => Yii::t('unidad_transporte', 'Sucursal Utransp'),
        ];
    }

    public static function getUnidadTransporte( )
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condicion = ['status_utransp = :status and sucursal_utransp = :sucursal', [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal]];


      $undTransp = UnidadTransporte::find()
      ->select(['id_utransp','des_utransp'])
      ->where($condicion[0], $condicion[1])
      ->orderBy('des_utransp')
      ->all();

      return  ArrayHelper::map( $undTransp, 'id_utransp', 'des_utransp');
    }
}
