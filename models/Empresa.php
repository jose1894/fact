<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property int $id_empresa ID UNICO
 * @property string $nombre_empresa NOMBRE EMPRESA
 * @property int $estatus_empresa ESTATUS EMPRESA
 * @property string $dni_empresa DNI EMPRESA
 * @property string $ruc_empresa RUC EMPRESA
 * @property int $tipopers_empresa TIPO PERSONA
 * @property string $tlf_empresa TELEFONO EMPRESA
 * @property string $direcc_empresa DIRECCION EMPRESA
 */
class Empresa extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa';
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
    /**
     * @var UploadedFile
     */
     public $image;
     public $cert;
     public function rules()
     {
         return [
             [['id_empresa', 'nombre_empresa', 'estatus_empresa', 'ruc_empresa',
               'tipopers_empresa','pais_empresa','depto_empresa', 'prov_empresa',
               'dtto_empresa'], 'required'],
             [['id_empresa', 'estatus_empresa', 'tipopers_empresa'], 'integer'],
             [['direcc_empresa'], 'string'],
             [['nombre_empresa', 'tlf_empresa','movil_empresa'], 'string', 'max' => 150],
             [['usuariosol_empresa', 'passsol_empresa','passcrtsol_empresa','cert_empresa'], 'string', 'max' => 255],
             [['dni_empresa'], 'string', 'max' => 20],
             [['correo_empresa'], 'string', 'max' => 70],
             [['ruc_empresa'], 'string', 'max' => 11],
             [['skin_empresa'], 'string', 'max' => 30],
             [['dni_empresa'], 'unique'],
             [['image','cert','skin_empresa'], 'safe'],
             [['image'], 'file', 'extensions'=>'jpg, gif, png'],
             [['cert'], 'file', 'extensions'=>'pem, crt, der'],
         ];
     }

     /**
      * {@inheritdoc}
      */
     public function attributeLabels()
     {
         return [
             'id_empresa' => Yii::t('empresa', 'Id'),
             'nombre_empresa' => Yii::t('empresa', 'Name'),
             'estatus_empresa' => Yii::t('empresa', 'Status'),
             'dni_empresa' => Yii::t('empresa', 'Dni'),
             'ruc_empresa' => Yii::t('empresa', 'Ruc'),
             'tipopers_empresa' => Yii::t('empresa', 'People type'),
             'tlf_empresa' => Yii::t('empresa', 'Phone'),
             'movil_empresa' => Yii::t('empresa', 'Mobile'),
             'correo_empresa' => Yii::t('empresa', 'Email'),
             'pais_empresa' => Yii::t('pais', 'Country'),
             'depto_empresa' => Yii::t('departamento', 'Estate / Department'),
             'prov_empresa' => Yii::t('provincia', 'Municipality / Province'),
             'dtto_empresa' => Yii::t('distrito', 'District / Parish'),
             'direcc_empresa' => Yii::t('empresa', 'Address'),
             'image' => Yii::t('empresa', 'Logo'),
             'cert' => Yii::t('empresa', 'SUNAT certificate'),
             'usuariosol_empresa' => Yii::t('empresa','SUNAT user'),
             'passsol_empresa' => Yii::t('empresa','SUNAT password'),
             'passcrtsol_empresa' => Yii::t('empresa','SUNAT certificate password'),
             'skin_empresa' => Yii::t('empresa','Skin'),
         ];
     }

     public function getSucursales()
    {
        return $this->hasMany(Sucursal::className(), ['empresa_suc' => 'id_empresa']);
    }

    public function getPaisEmpresa()
    {
       return $this->hasOne(Pais::className(), ['pais_empresa' => 'id_pais']);
    }

    public function getDeptoEmpresa()
    {
       return $this->hasOne(Departamento::className(), ['dpto_empresa' => 'id_depto']);
    }

    public function getProvEmpresa()
    {
       return $this->hasOne(Provincia::className(), ['prov_empresa' => 'id_prov']);
    }

    public function getDttoEmpresa()
    {
       return $this->hasOne(Distrito::className(), ['dtto_empresa' => 'id_dtto']);
    }

    public static function empresaList()
    {
      $empresas = self::find()->where(['estatus_empresa' => 1])
      ->orderBy('nombre_empresa')
      ->all();

      return ArrayHelper::map($empresas,'id_empresa','nombre_empresa');

    }

    /* Obtiene el nombre de la empresa */
    public static function getEmpresa()
    {
      return self::find()->where(['estatus_empresa' => 1])->one();
    }
}
