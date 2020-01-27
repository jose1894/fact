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
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
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
            [['tipo_num','sucursal_num', 'status_num'], 'integer'],
            [['tipo_num','serie_num','numero_num', 'status_num'], 'required'],
            [['numero_num'], 'string', 'max' => 10],
            [['serie_num'], 'string', 'max' => 2],
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
          [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal, ':tipo' => $tipo]
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

    public static function getNumeracion( $tipo, $serie = false )
    {
      $user = User::findOne(Yii::$app->user->id);
      $sucursal = $user->sucursal0->id_suc;

      if ( $serie ){

        $serie = self::getSerieNum( $tipo );

        $condicion = [
            'status_num = :status and sucursal_num = :sucursal and tipo_documento.abrv_tipod like :tipo and serie_num like :serie ',
            [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal, ':tipo' => $tipo, ':serie' => $serie['serie_num']]
          ];
      } else {
        $condicion = [
          'status_num = :status and sucursal_num = :sucursal and tipo_documento.abrv_tipod like :tipo',
          [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal, ':tipo' => $tipo]
        ];
      }

      $numeraciones = Numeracion::find()
                ->joinWith('tipoDocumento')
                 ->where( $condicion[0], $condicion[1] )
                ->orderBy('serie_num')
                ->all();
      $numeracion = [];
      foreach ($numeraciones as $value) {        // code...
        $numeracion[] = [
            'id_num' => $value->id_num,
            'tipo_num' => $value->tipo_num,
            'serie_num' => $value->serie_num,
            'numero_num' => $value->numero_num,
            'abrv_tipod' => $value->tipoDocumento->abrv_tipod
          ];
      }
      return  $numeracion;
    }

    public static function getNumerationById( $id ){
        $numeracion = [];
        $user = User::findOne(Yii::$app->user->id);
        $sucursal = $user->sucursal0->id_suc;

        $numeracion = Numeracion::find()
            ->joinWith('tipoDocumento')
            ->where( [
                'status_num = :status and sucursal_num = :sucursal and id_num = :id',
                [':status' => self::STATUS_ACTIVE, ':sucursal' => $sucursal, ':id' => $id]
            ] )
            ->orderBy('serie_num')
            ->all();

        return  $numeracion;

    }
}
