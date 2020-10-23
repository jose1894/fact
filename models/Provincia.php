<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "provincia".
 *
 * @property int $id_prov ID UNICO
 * @property string $des_prov DESCRIPCION PROVINCIA
 * @property int $status_prov ESTATUS PROVINCIA
 * @property int $sucursal_prov SUCURSAL PROVINCIA
 * @property int $pais_prov
 *
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincia';
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
            [['des_prov', 'status_prov', 'depto_prov', 'pais_prov'], 'required'],
            [['status_prov', 'sucursal_prov', 'pais_prov'], 'integer'],
            // [['pais_prov'],'string'],
            [['des_prov'], 'string', 'max' => 30],
            [['depto_prov'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['depto_prov' => 'id_depto']],
            [['pais_prov'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_prov' => 'id_pais']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prov' => Yii::t('provincia', 'Id'),
            'cod_prov' => Yii::t('provincia', 'Code'),
            'des_prov' => Yii::t('provincia', 'Name'),
            'pais_prov' => Yii::t('pais', 'Country'),
            'status_prov' => Yii::t('provincia', 'Status'),
            'sucursal_prov' => Yii::t('provincia', 'Sucursal Prov'),
            'depto_prov' => Yii::t('departamento', 'Estate / Department'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getDepartamentos()
    // {
    //     return $this->hasMany(Departamento::className(), ['prov_depto' => 'id_prov']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaisProv()
    {
        return $this->hasOne(Pais::className(), ['id_pais' => 'pais_prov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeptoProv()
    {
        return $this->hasOne(Departamento::className(), ['id_depto' => 'depto_prov']);
    }

    public static function getProvinciaList( $pais, $depto )
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condiciones = Provincia::find()
                     ->where(
                       'status_prov = :status and sucursal_prov = :sucursal and pais_prov = :pais and depto_prov = :depto',
                       [':status' => 1, ':sucursal' => $sucursal, ':depto' => $depto, ':pais' => $pais])
                     ->orderBy('des_prov')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_prov', 'des_prov');
    }

}
