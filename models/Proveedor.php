<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $id_prove ID UNICO
 * @property string $dni_prove DNI PROVEEDOR
 * @property string $ruc_prove RUC PROVEEDOR
 * @property string $nombre_prove NOMBRE PROVEEDOR
 * @property string $direcc_prove DIRECCION PROVEEDOR
 * @property int $pais_prove PAIS PROVEEDOR
 * @property int $depto_prove DEPARTAMENTO PROVEEDOR
 * @property int $provi_prove PROVINCIA PROVEEDOR
 * @property int $dtto_prove DISTRITO PROVEEDOR
 * @property string $tlf_prove TELEFONO PROVEEDOR
 * @property int $tipo_prove TIPO PROVEEDOR
 * @property int $status_prove ESTATUS PROVEEDOR
 * @property int $sucursal_prove
 *
 * @property Pais $paisProve
 * @property Provincia $proviProve
 * @property Departamento $deptoProve
 * @property Distrito $dttoProve
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'nombre_prove', 'direcc_prove',  'tipo_prove', 'status_prove'], 'required'],
            [['direcc_prove'], 'string'],
            [['pais_prove', 'depto_prove', 'provi_prove', 'dtto_prove', 'tipo_prove', 'status_prove', 'sucursal_prove'], 'integer'],
            [['dni_prove', 'ruc_prove'], 'string', 'max' => 20],
            [['nombre_prove'], 'string', 'max' => 150],
            [['tlf_prove'], 'string', 'max' => 100],
            [['pais_prove'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_prove' => 'id_pais']],
            [['provi_prove'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provi_prove' => 'id_prov']],
            [['depto_prove'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['depto_prove' => 'id_depto']],
            [['dtto_prove'], 'exist', 'skipOnError' => true, 'targetClass' => Distrito::className(), 'targetAttribute' => ['dtto_prove' => 'id_dtto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prove' => Yii::t('proveedor', 'Id'),
            'dni_prove' => Yii::t('proveedor', 'Dni'),
            'ruc_prove' => Yii::t('proveedor', 'Ruc'),
            'nombre_prove' => Yii::t('proveedor', 'Name'),
            'direcc_prove' => Yii::t('proveedor', 'Address'),
            'pais_prove' => Yii::t('pais', 'Country'),
            'depto_prove' => Yii::t('departamento', 'Department / County / Municipality'),
            'provi_prove' => Yii::t('provincia', 'Estate / Province'),
            'dtto_prove' => Yii::t('distrito', 'District / Parish'),
            'tlf_prove' => Yii::t('proveedor', 'Phone'),
            'tipo_prove' => Yii::t('proveedor', 'Type'),
            'status_prove' => Yii::t('proveedor', 'Status'),
            'sucursal_prove' => Yii::t('proveedor', 'Sucursal Prove'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaisProve()
    {
        return $this->hasOne(Pais::className(), ['id_pais' => 'pais_prove']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviProve()
    {
        return $this->hasOne(Provincia::className(), ['id_prov' => 'provi_prove']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeptoProve()
    {
        return $this->hasOne(Departamento::className(), ['id_depto' => 'depto_prove']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDttoProve()
    {
        return $this->hasOne(Distrito::className(), ['id_dtto' => 'dtto_prove']);
    }
}
