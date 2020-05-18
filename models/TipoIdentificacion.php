<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_identificacion".
 *
 * @property int $id_tipoi ID UNICO
 * @property string $cod_tipoi CODIGO DE TIPO DE IDENTIFICACION
 * @property string $des_tipoi DESCRIPCION TIPO IDENTIFICACION
 * @property int $status_tipoi STATUS DE TIPO DE IDENTIFICACION
 * @property int $sucursal_tipoi SUCURSAL TIPO DE IDENTIFICACION
 */
class TipoIdentificacion extends \yii\db\ActiveRecord
{
    const TIPO_DNI = '1';
    const TIPO_RUC = '6';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_identificacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_tipoi'], 'required'],
            [['status_tipoi', 'sucursal_tipoi'], 'integer'],
            [['cod_tipoi'], 'string', 'max' => 1],
            [['des_tipoi'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipoi' => Yii::t('tipo_identificacion', 'Id Tipoi'),
            'cod_tipoi' => Yii::t('tipo_identificacion', 'Cod Tipoi'),
            'des_tipoi' => Yii::t('tipo_identificacion', 'Des Tipoi'),
            'status_tipoi' => Yii::t('tipo_identificacion', 'Status Tipoi'),
            'sucursal_tipoi' => Yii::t('tipo_identificacion', 'Sucursal Tipoi'),
        ];
    }

    public static function getTipoIdList()
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $tipoid = self::find()
                     ->select(['id_tipoi', 'CONCAT(cod_tipoi,\' | \',des_tipoi) AS des_tipoi'])
                     ->where('status_tipoi = :status and sucursal_tipoi = :sucursal',[':status' => 1, ':sucursal' => $sucursal])
                     ->orderBy('des_tipoi')
                     ->all();
      return ArrayHelper::map( $tipoid, 'id_tipoi', 'des_tipoi');
    }
}
