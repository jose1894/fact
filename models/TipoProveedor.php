<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_proveedor".
 *
 * @property int $id_tprov
 * @property string $des_tprov
 * @property int $status_tprov
 * @property int $sucursal_tprov
 */
class TipoProveedor extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_tprov','status_tprov'], 'required'],
            [['status_tprov', 'sucursal_tprov'], 'integer'],
            [['des_tprov'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tprov' => Yii::t('tipo_proveedor', 'Id'),
            'des_tprov' => Yii::t('tipo_proveedor', 'Description'),
            'status_tprov' => Yii::t('tipo_proveedor', 'Status'),
            'sucursal_tprov' => Yii::t('tipo_proveedor', 'Sucursal Tprov'),
        ];
    }

    public static function getTipoProveedor( )
    {
        $user = User::findOne(Yii::$app->user->id);
        $sucursal = $user->sucursal0->id_suc;

        $condicion = ['status_tprov = :status and sucursal_tprov = :sucursal', [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal]];


        $tipoprov = self::find()
            ->select(['id_tprov','des_tprov'])
            ->where($condicion[0], $condicion[1])
            ->orderBy('des_tprov')
            ->all();

        return  ArrayHelper::map( $tipoprov, 'id_tprov', 'des_tprov');
    }
}
