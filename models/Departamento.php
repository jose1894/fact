<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "departamento".
 *
 * @property int $id_depto ID UNICO
 * @property int $cod_depto CODIGO UBIGEO
 * @property string $des_depto DESCRIPCION DEPARTAMENTO
 * @property int $status_depto ESTATUS DEPARTAMENTO
 * @property int $sucursal_depto SUCURSAL DEPARTAMENTO
 *
 * @property Provincia[] $provincias
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
            [['des_depto', 'pais_depto', 'status_depto'], 'required'],
            [['status_depto', 'sucursal_depto'], 'integer'],
            [['des_depto'], 'string', 'max' => 30],
            [['pais_depto'], 'string'],
            [['pais_depto'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_depto' => 'id_pais']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_depto' => Yii::t('departamento', 'Id'),
            'cod_depto' => Yii::t('departamento', 'Code'),
            'des_depto' => Yii::t('departamento', 'Name'),
            'prov_depto' => Yii::t('departamento', 'Estate / Department'),
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
    public function getProvincias()
    {
        return $this->hasMany(Provincia::className(), ['depto_prov' => 'id_depto']);
    }

    public static function getDeptoList( $pais )
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condiciones = Departamento::find()
                     ->where(
                       'status_depto = :status and sucursal_depto = :sucursal and pais_depto = :pais',
                       [':status' => 1, ':sucursal' => $sucursal, ':pais' => $pais])
                     ->orderBy('des_depto')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_depto', 'des_depto');
    }
}
