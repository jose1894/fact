<?php

namespace app\models;

use yii\helpers\ArrayHelper;

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

    /**
     * {@inheritdoc}
     */
     public function rules()
     {
         return [
             [['id_empresa', 'nombre_empresa', 'estatus_empresa',  'ruc_empresa', 'tipopers_empresa'], 'required'],
             [['id_empresa', 'estatus_empresa', 'tipopers_empresa'], 'integer'],
             [['direcc_empresa'], 'string'],
             [['nombre_empresa', 'tlf_empresa','movil_empresa'], 'string', 'max' => 150],
             [['dni_empresa'], 'string', 'max' => 20],
             [['correo_empresa'], 'string', 'max' => 70],
             [['ruc_empresa'], 'string', 'max' => 11],
             [['dni_empresa'], 'unique'],
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
             'direcc_empresa' => Yii::t('empresa', 'Address'),
         ];
     }

     public function getSucursales()
    {
        return $this->hasMany(Sucursal::className(), ['empresa_suc' => 'id_empresa']);
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
