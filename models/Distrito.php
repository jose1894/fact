<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['des_dtto', 'depto_dtto', 'status_dtto','pais_dtto', 'prov_dtto'], 'required'],
            [['depto_dtto', 'status_dtto', 'sucursal_dtto'], 'integer'],
            [['des_dtto'], 'string', 'max' => 30],
            [['prov_dtto' , 'pais_dtto', 'depto_dtto'], 'string'],
            [['pais_dtto'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_dtto' => 'id_pais']],
            [['prov_dtto'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['prov_dtto' => 'id_prov']],
            [['depto_dtto'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['depto_dtto' => 'id_depto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dtto' => Yii::t('distrito', 'Id'),
            'cod_dtto' => Yii::t('distrito', 'Code'),
            'des_dtto' => Yii::t('distrito', 'Name'),
            'pais_dtto' => Yii::t('pais', 'Country'),
            'depto_dtto' => Yii::t('departamento', 'Estate / Department'),
            'prov_dtto' => Yii::t('provincia', 'Municipality / Province'),
            'status_dtto' => Yii::t('distrito', 'Status'),
            'sucursal_dtto' => Yii::t('distrito', 'Sucursal Dtto'),
        ];
    }

    public function getPaisDtto()
    {
        return $this->hasOne(Pais::className(), ['id_pais' => 'pais_dtto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvDtto()
    {
        return $this->hasOne(Provincia::className(), ['id_prov' => 'prov_dtto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeptoDtto()
    {
        return $this->hasOne(Departamento::className(), ['id_depto' => 'depto_dtto']);
    }

    public static function getDttoList( $pais, $departamento, $provincia )
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condiciones = Distrito::find()
                     ->where(
                       'status_dtto = :status and sucursal_dtto = :sucursal and pais_dtto = :pais and prov_dtto = :provincia and depto_dtto = :departtamento',
                       [':status' => 1, ':sucursal' => $sucursal, ':pais' => $pais, ':provincia' => $provincia, ':departamento' => $departamento])
                     ->orderBy('des_dtto')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_dtto', 'des_dtto');
    }
}
