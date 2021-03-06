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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['numerar'] = ['numero_num','required'];
        return $scenarios;
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
            [['tipo_num','serie_num'], 'unique', 'targetAttribute' => ['tipo_num', 'serie_num']],
            [['numero_num'], 'required', 'on' => 'numerar'],
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
        return $this->hasOne(TipoDocumento::className(), ['id_tipod' => 'tipo_num','sucursal_tipod' => 'sucursal_num']);
    }

    /*public static function getSerieNum( $tipo )
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;

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
        $serie[] = [
          'id_num' => $value->id_num,
          'tipo_num' => $value->tipo_num,
          'serie_num' => $value->serie_num,
          'numero_num' => $value->numero_num,
          'abrv_tipod' => $value->tipoDocumento->abrv_tipod
        ];
      }

      return  $serie;
    }*/

    public static function getNumeracion( $tipo, $serie = false )
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;

      if ( $serie ){
        $condicion = [
            'status_num = :status and sucursal_num = :sucursal and
			tipo_documento.abrv_tipod like :tipo and serie_num = :serie ',
            [
				':status' => self::STATUS_ACTIVE,
				':sucursal' => $sucursal,
				':tipo' => $tipo,
				':serie' => $serie
			]
          ];
      } else {
        $condicion = [
          'status_num = :status and sucursal_num = :sucursal and
		  tipo_documento.abrv_tipod like :tipo',
          [
			':status' => self::STATUS_ACTIVE,
			':sucursal' => $sucursal,
			':tipo' => $tipo,
		  ]
        ];
      }

      $numeraciones = Numeracion::find()
                ->joinWith('tipoDocumento')
                 ->where( $condicion[0], $condicion[1] )
                ->orderBy('serie_num')
                ->all();

		//echo $query->createCommand()->sql;
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

    public static function getNumeracionById( $id ){
        $numeracion = [];
        $sucursal = Yii::$app->user->identity->profiles->sucursal;

        $numeracion = Numeracion::find()
            ->joinWith('tipoDocumento')
            ->where( [
                'status_num' => self::STATUS_ACTIVE,
                'sucursal_num' => $sucursal,
                'id_num' =>$id
            ] )
            ->orderBy('serie_num')
            ->one();

        return  $numeracion;

    }
}
