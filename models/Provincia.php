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
 * @property Departamento[] $departamentos
 * @property Pais $paisProv
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_prov', 'status_prov', 'pais_prov'], 'required'],
            [['status_prov', 'sucursal_prov'], 'integer'],
            [['pais_prov'],'string'],
            [['des_prov'], 'string', 'max' => 30],
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
            'des_prov' => Yii::t('provincia', 'Name'),
            'status_prov' => Yii::t('provincia', 'Status'),
            'sucursal_prov' => Yii::t('provincia', 'Sucursal Prov'),
            'pais_prov' => Yii::t('provincia', 'Country'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamento::className(), ['prov_depto' => 'id_prov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaisProv()
    {
        return $this->hasOne(Pais::className(), ['id_pais' => 'pais_prov']);
    }

    public static function getProvinciaList( $pais )
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condiciones = Provincia::find()
                     ->where('status_prov = :status and sucursal_prov = :sucursal and pais_prov = :pais',[':status' => 1, ':sucursal' => $sucursal, ':pais' => $pais])
                     ->orderBy('des_prov')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_prov', 'des_prov');
    }

}
