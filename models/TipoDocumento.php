<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_documento".
 *
 * @property int $id_tipod ID UNICO
 * @property string $des_tipod DESCRIPCION TIPO DOCUMENTO
 * @property int $sucursal_tipod SUCURSAL TIPO DOCUMENTO
 * @property int $status_tipod ESTATUS TIPO DOCUMENTO
 * @property int $tipo_tipod TIPO DE DOCUMENTO 0 = ES PEDIDO, 1 = ES DOCUMENTO, 2 = ES GUIA
 *
 * @property Numeracion[] $numeracions
 */
class TipoDocumento extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVO = 1;
    const STATUS_INACTIVO = 0;
    const ES_DOCUMENTO = 1;
    const ES_GUIA = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sucursal_tipod', 'status_tipod', 'tipo_tipod'], 'integer'],
            [['des_tipod'], 'string', 'max' => 100],
            [['abrv_tipod'], 'string', 'max' => 4],
            [['tipodsunat_tipod'], 'string', 'max' => 2],
            [['ope_tipod'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipod' => Yii::t('tipo_documento', 'Id'),
            'des_tipod' => Yii::t('tipo_documento', 'Description'),
            'sucursal_tipod' => Yii::t('tipo_documento', 'Sucursal'),
            'status_tipod' => Yii::t('tipo_documento', 'Status'),
            'abrv_tipod' => Yii::t('tipo_documento', 'Abbreviation'),
            'tipo_tipod' => Yii::t('tipo_documento', 'Type'),
            'ope_tipod' => Yii::t('tipo_documento', 'Operation'),
            'tipodsunat_tipod' => Yii::t('tipo_documento', 'SUNAT doc type'),
        ];
    }

    public static function getTipoDocumento( $tipo = null, $esDoc = null)
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condicion = ['status_tipod = :status and sucursal_tipod = :sucursal', [':status' => self::STATUS_ACTIVO, ':sucursal' => $sucursal]];

      if ( !is_null($esDoc) && $esDoc ==  self::ES_DOCUMENTO) {
        $condicion[ 0 ] .= ' and tipo_tipod = :documento ';
        $condicion[ 1 ][ ':documento' ] = self::ES_DOCUMENTO;
      }

      if ( !is_null($esDoc) && $esDoc == self::ES_GUIA){
          $condicion[ 0 ] .= ' and tipo_tipod = :guia ';
          $condicion[ 1 ][ ':guia' ] = self::ES_GUIA;
      }

      if ( !is_null($tipo) || $tipo ){
        $condicion[ 0 ] .= ' and ope_tipod like :tipo ';
        $condicion[ 1 ][ ':tipo' ] = $tipo;
      }

      // if ( !is_null($esDoc) || $esDoc != 0 ){
        $tipom = TipoDocumento::find()
        //->joinWith('numeracions')
        ->where($condicion[0], $condicion[1])
        ->orderBy('des_tipod')
        ->all();

        $tipoDoc = [];
        foreach ($tipom as $value) {
           // code...

           foreach ($value->numeracions as $value2) {
             // code...
             $tipoDoc[] = [
               'id_num'       => $value2->id_num,
               'id_tipod'     => $value->id_tipod,
               'des_tipod'    => $value->abrv_tipod ."/". $value2->serie_num . " - ". $value->des_tipod,
             ];
           }
        }
     // } else {
     //    $tipom = TipoDocumento::find()
     //              ->select(['id_tipod','CONCAT(abrv_tipod," - ", des_tipod) AS des_tipod'])
     //              ->where($condicion[0], $condicion[1])
     //              ->orderBy('des_tipod')
     //              ->all();
     //    $tipoDoc = [];
     //    foreach ($tipom as $value) {
     //      // code...
     //      $tipoDoc = [
     //        'id_num'       => $value->id_num,
     //        'id_tipod'     => $value->id_tipod,
     //        'des_tipod'    => $value->des_tipod,
     //      ];
     //    }
      //}
      return  $tipoDoc;
    }

    public function getTipoDocumentoById( $id = null)
    {
      if( is_null($id) ) {
        return NULL;
      }

$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condicion = ['status_tipod = :status and sucursal_tipod = :sucursal and  id_tipod = :id', [':status' => self::STATUS_ACTIVO, ':sucursal' => $sucursal, ':id' => $id]];

      $tipom = TipoDocumento::find()
      ->where($condicion[0],$condicion[1])
      ->one();

      return str_pad(  $tipom->numeracions[0]->numero_num + 1, 10, '0', STR_PAD_LEFT);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeracions()
    {
        return $this->hasMany(Numeracion::className(), ['tipo_num' => 'id_tipod']);
    }


}
