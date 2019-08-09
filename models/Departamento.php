<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "departamento".
 *
 * @property int $id_depto ID UNICO
 * @property string $des_depto DESCRIPCION DEPARTAMENTO
 * @property int $prov_depto PROVINCIA DEPARTAMENTO
 * @property int $status_depto ESTATUS DEPARTAMENTO
 * @property int $sucursal_depto SUCURSAL DEPARTAMENTO
 *
 * @property Provincia $provDepto
 * @property Distrito[] $distritos
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_depto', 'pais_depto', 'prov_depto', 'status_depto'], 'required'],
            [['prov_depto', 'status_depto', 'sucursal_depto'], 'integer'],
            [['des_depto'], 'string', 'max' => 30],
            [['prov_depto' , 'pais_depto'], 'string'],
            [['pais_depto'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_depto' => 'id_pais']],
            [['prov_depto'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['prov_depto' => 'id_prov']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_depto' => Yii::t('departamento', 'Id'),
            'des_depto' => Yii::t('departamento', 'Name'),
            'prov_depto' => Yii::t('provincia', 'Estate / Province'),
            'pais_depto' => Yii::t('pais', 'Country'),
            'status_depto' => Yii::t('departamento', 'Status'),
            'sucursal_depto' => Yii::t('departamento', 'Sucursal Depto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaisDepto()
    {
        return $this->hasOne(Pais::className(), ['id_pais' => 'pais_depto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvDepto()
    {
        return $this->hasOne(Provincia::className(), ['id_prov' => 'prov_depto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistritos()
    {
        return $this->hasMany(Distrito::className(), ['depto_dtto' => 'id_depto']);
    }

    public static function getDeptoList( $pais, $provincia )
    {
      $user = User::findOne(Yii::$app->user->id);
      $sucursal = $user->sucursal0->id_suc;

      $condiciones = Departamento::find()
                     ->where(
                       'status_depto = :status and sucursal_depto = :sucursal and pais_depto = :pais and prov_depto = :provincia',
                       [':status' => 1, ':sucursal' => $sucursal, ':pais' => $pais, ':provincia' => $provincia])
                     ->orderBy('des_depto')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_depto', 'des_depto');
    }
}
