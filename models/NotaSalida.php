<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaccion".
 *
 * @property int $id_trans ID UNICO
 * @property string $codigo_trans CODIGO TRANSACCION
 * @property string $fecha_trans FECHA TRANSACCION
 * @property string $obsv_trans OBSERVACIONES TRANSACCION
 * @property int $tipo_trans TIPO TRANSACCION
 * @property string $docref_trans DOCUMENTO REFERENCIA TRANSACCION
 * @property int $almacen_trans ALMACEN TRANSACCION
 */
class NotaSalida extends \yii\db\ActiveRecord
{
    const STATUS_UNAPPROVED = 0;
    const STATUS_APPROVED = 1;
    const STATUS_CANCELED = 2;
    const OPE_TRANS = 'S';
    const NOTA_SALIDA = 'NS';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaccion';
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
          [['fecha_trans'], 'safe'],
          [['obsv_trans'], 'string'],
          [['tipo_trans', 'almacen_trans', 'sucursal_trans', 'status_trans'], 'integer'],
          [['almacen_trans','tipo_trans','sucursal_trans','moneda_trans'], 'required'],
          [['codigo_trans',], 'string', 'max' => 10],
          [['docref_trans',], 'string', 'max' => 25],
          [['tipo_trans'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMovimiento::className(), 'targetAttribute' => ['tipo_trans' => 'id_tipom']],
          [['almacen_trans'], 'exist', 'skipOnError' => true, 'targetClass' => Almacen::className(), 'targetAttribute' => ['almacen_trans' => 'id_almacen']],
          [['moneda_trans'], 'exist', 'skipOnError' => true, 'targetClass' => Moneda::className(), 'targetAttribute' => ['moneda_trans' => 'id_moneda']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'id_trans' => Yii::t('salida', 'Id'),
          'codigo_trans' => Yii::t('salida', 'Code'),
          'fecha_trans' => Yii::t('salida', 'Date'),
          'obsv_trans' => Yii::t('salida', 'Comments'),
          'tipo_trans' => Yii::t('tipo_movimiento', 'Movement type'),
          'docref_trans' => Yii::t('salida', 'Document'),
          'almacen_trans' => Yii::t('almacen', 'Warehouse'),
          'sucursal_trans' => Yii::t('salida', 'sucursal'),
          'usuario_trans' => Yii::t('salida', 'usuario'),
          'status_trans' => Yii::t('salida', 'Status'),
          'moneda_trans' => Yii::t('moneda', 'Currency'),
        ];
    }


        public function getDetalles()
        {
           return $this->hasMany(NotaSalidaDetalle::className(), ['trans_detalle' => 'id_trans']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getTipoTrans()
        {
            return $this->hasOne(TipoMovimiento::className(), ['id_tipom' => 'tipo_trans']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getAlmacenTrans()
        {
            return $this->hasOne(Almacen::className(), ['id_almacen' => 'almacen_trans']);
        }

        public static function getStatuses()
        {
          return [ Yii::t('app','NOT APPROVED'), Yii::t('app','APPROVED'), Yii::t('app','CANCELED')];
        }
}
