<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distrito".
 *
 * @property int $id_dtto ID UNICO
 * @property string $des_dtto DESCRIPCION DISTRITO
 * @property int $depto_dtto DEPARTAMENTO DISTRITO
 * @property int $status_dtto ESTATUS DISTRITO
 * @property int $sucursal_dtto SUCURSAL DISTRITO
 *
 * @property Departamento $deptoDtto
 */
class Distrito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_dtto', 'depto_dtto', 'status_dtto', 'sucursal_dtto'], 'required'],
            [['depto_dtto', 'status_dtto', 'sucursal_dtto'], 'integer'],
            [['des_dtto'], 'string', 'max' => 30],
            [['depto_dtto'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['depto_dtto' => 'id_depto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dtto' => Yii::t('distrito', 'Id Dtto'),
            'des_dtto' => Yii::t('distrito', 'Des Dtto'),
            'depto_dtto' => Yii::t('distrito', 'Depto Dtto'),
            'status_dtto' => Yii::t('distrito', 'Status Dtto'),
            'sucursal_dtto' => Yii::t('distrito', 'Sucursal Dtto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeptoDtto()
    {
        return $this->hasOne(Departamento::className(), ['id_depto' => 'depto_dtto']);
    }
}
