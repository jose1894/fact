<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "moneda".
 *
 * @property int $id_moneda ID UNICO
 * @property string $des_moneda DESCRIPCION MONEDA
 * @property string $tipo_moneda TIPO MONEDA
 * @property int $status_moneda ESTATUS MONEDA
 * @property int $sucursal_moneda SUCURSAL MONEDA
 */
class Moneda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'moneda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_moneda', 'status_moneda', 'tipo_moneda'], 'required'],
            [['status_moneda', 'sucursal_moneda'], 'integer'],
            [['des_moneda'], 'string', 'max' => 50],
            [['tipo_moneda'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_moneda' => Yii::t('moneda', 'Id'),
            'des_moneda' => Yii::t('moneda', 'Description'),
            'tipo_moneda' => Yii::t('moneda', 'Type'),
            'status_moneda' => Yii::t('moneda', 'Status'),
            'sucursal_moneda' => Yii::t('moneda', 'Sucursal Moneda'),
        ];
    }

    public static function getMonedasList()
    {
      $user = User::findOne(Yii::$app->user->id);
      $sucursal = $user->sucursal0->id_suc;

      $monedas = Moneda::find()
                 ->where('status_moneda = :status and sucursal_moneda = :sucursal',[':status' => 1, ':sucursal' => $sucursal])
                ->orderBy('des_moneda')
                ->all();
      return  ArrayHelper::map( $monedas, 'id_moneda', 'des_moneda');
    }
}
