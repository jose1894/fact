<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "numeracion".
 *
 * @property int $id_num ID UNICO
 * @property int $tipo_num TIPO NUMERACION
 * @property string $numero_num NUMERO NUMERACION
 * @property int $sucursal_num SUCURSAL NUMERACION
 * @property string $serie_num SERIE NUMERACION
 * @property int $status_num ESTATUS NUMERACION
 *
 * @property TipoDocumento $tipoNum
 */
class Numeracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'numeracion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_num', 'sucursal_num', 'status_num'], 'integer'],
            [['serie_num'], 'required'],
            [['numero_num'], 'string', 'max' => 10],
            [['serie_num'], 'string', 'max' => 4],
            [['tipo_num'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDocumento::className(), 'targetAttribute' => ['tipo_num' => 'id_tipod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num' => Yii::t('numeracion', 'Id'),
            'tipo_num' => Yii::t('tipo_documento', 'Document type'),
            'numero_num' => Yii::t('numeracion', 'Number'),
            'sucursal_num' => Yii::t('numeracion', 'Sucursal Num'),
            'serie_num' => Yii::t('serie', 'Serie'),
            'status_num' => Yii::t('numeracion', 'Status Num'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDocumento()
    {
        return $this->hasOne(TipoDocumento::className(), ['id_tipod' => 'tipo_num']);
    }

    public static function getSerieNum( $tipo )
    {
      $user = User::findOne(Yii::$app->user->id);
      $sucursal = $user->sucursal0->id_suc;

      $condicion = [
          "status_num = :status and sucursal_num = :sucursal and tipo_documento.abrv_tipod like :tipo",
          [':status' => 1, ':sucursal' => $sucursal, ':tipo' => $tipo]
        ];

      $series = Numeracion::find()
                ->joinWith('tipoDocumento')
                ->where( $condicion[0],$condicion[1] )
                ->orderBy('serie_num')
                ->all();

      foreach ($series as $value) {
        // code...
        $serie = [
          'id_num' => $value->id_num,
          'tipo_num' => $value->tipo_num,
          'serie_num' => $value->serie_num,
          'numero_num' => $value->numero_num,
          'abrv_tipod' => $value->tipoDocumento->abrv_tipod
        ];
      }

      return  $serie;
    }

    public static function getNumeracion( $tipo, $serie = null )
    {
      $user = User::findOne(Yii::$app->user->id);
      $sucursal = $user->sucursal0->id_suc;

      if ( is_null($serie) ){
        $condicion = [
          'status_num = :status and sucursal_num = :sucursal ',
          [':status' => 1, ':sucursal' => $sucursal]
        ];
      } else {
        $condicion = [
            'status_num = :status and sucursal_num = :sucursal and tipo_documento.tipo_num like :tipo ',
            [':status' => 1, ':sucursal' => $sucursal, ':tipo' => $tipo]
          ];
      }

      $numeraciones = Numeracion::find()
                ->joinWith('tipoDocumento')
                 ->where( $condicion[0], $condicion[1] )
                ->orderBy('serie_num')
                ->all();

      foreach ($numeraciones as $value) {
        // code...
        $numeracion = [
            'id_num' => $value->id_num,
            'tipo_num' => $value->tipo_num,
            'serie_num' => $value->serie_num,
            'numero_num' => $value->numero_num,
            'abrv_tipod' => $value->tipoDocumento->abrv_tipod
          ];
      }
      return  $numeracion;
    }
}
