<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [[ 'nombre_prove',  'tipo_prove', 'status_prove'], 'required'],
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
            'depto_prove' => Yii::t('departamento', 'Estate / Department'),
            'provi_prove' => Yii::t('provincia', 'Municipality / Province'),
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

    public static function getProveedorList()
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condiciones = Proveedor::find()
                     ->where('status_prove = :status and sucursal_prove = :sucursal',[':status' => 1, ':sucursal' => $sucursal])
                     ->orderBy('nombre_prove')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_prove', 'nombre_prove');
    }
}
