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
            [['abrv_tipod','ope_tipod'], 'string', 'max' => 3],
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
        ];
    }

    public static function getTipoDocumento( $tipo = null, $esDoc = null )
    {
      $user = User::findOne(Yii::$app->user->id);
      $sucursal = $user->sucursal0->id_suc;

      $condicion = ['status_tipod = :status and sucursal_tipod = :sucursal', [':status' => self::STATUS_ACTIVO, ':sucursal' => $sucursal]];

      if ( !is_null($esDoc) ) {
        $condicion[ 0 ] .= ' and tipo_tipod = :documento ';
        $condicion[ 1 ][ ':documento' ] = self::ES_DOCUMENTO;
      }


      if ( !is_null($tipo) ){
        $condicion[ 0 ] .= ' and ope_tipod like :tipo ';
        $condicion[ 1 ][ ':tipo' ] = $tipo;
      }

      $tipom = TipoDocumento::find()
                 ->where($condicion[0], $condicion[1])
                ->orderBy('des_tipod')
                ->all();
      return  ArrayHelper::map( $tipom, 'id_tipod', 'des_tipod');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeracions()
    {
        return $this->hasMany(Numeracion::className(), ['tipo_num' => 'id_tipod']);
    }


}
