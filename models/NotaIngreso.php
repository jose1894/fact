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
class NotaIngreso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_trans'], 'safe'],
            [['obsv_trans'], 'string'],
            [['tipo_trans', 'almacen_trans', 'sucursal_trans', 'usuario_trans'], 'integer'],
            [['almacen_trans','tipo_trans','sucursal_trans', 'usuario_trans'], 'required'],
            [['codigo_trans', 'docref_trans'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_trans' => Yii::t('ingreso', 'Id'),
            'codigo_trans' => Yii::t('ingreso', 'Code'),
            'fecha_trans' => Yii::t('ingreso', 'Date'),
            'obsv_trans' => Yii::t('ingreso', 'Comments'),
            'tipo_trans' => Yii::t('ingreso', 'Type movement'),
            'docref_trans' => Yii::t('ingreso', 'Doc. Ref.'),
            'almacen_trans' => Yii::t('ingreso', 'Warehouse'),
            'sucursal_trans' => Yii::t('ingreso', 'sucursal'),
            'usuario_trans' => Yii::t('ingreso', 'usuario'),
        ];
    }

    public function getDetalles()
    {
       return $this->hasMany(NotaIngresoDetalle::className(), ['trans_detalle' => 'id_trans']);
    }
}
