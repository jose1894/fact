<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_cambio".
 *
 * @property int $id_tipoc ID UNICO
 * @property string $fecha_tipoc FECHA TIPO CAMBIO
 * @property int $monedac_tipoc MONEDA A CAMBIAR
 * @property int $moneda_tipoc MONEDA CAMBIADA
 * @property int $cambioc_tipoc VALOR COMPRA TIPO CAMBIO
 * @property int $venta_tipoc VALOR DE VENTA TIPO CAMBIO
 * @property int $valorf_tipoc VALOR A FACTURAR
 */
class TipoCambio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_cambio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_tipoc', 'monedac_tipoc', 'moneda_tipoc', 'cambioc_tipoc', 'venta_tipoc', 'valorf_tipoc'], 'required'],
            [['fecha_tipoc'], 'safe'],
            [['monedac_tipoc', 'moneda_tipoc', 'cambioc_tipoc', 'venta_tipoc', 'valorf_tipoc'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipoc' => Yii::t('tipo_cambio', 'Id Tipoc'),
            'fecha_tipoc' => Yii::t('tipo_cambio', 'Fecha Tipoc'),
            'monedac_tipoc' => Yii::t('tipo_cambio', 'Monedac Tipoc'),
            'moneda_tipoc' => Yii::t('tipo_cambio', 'Moneda Tipoc'),
            'cambioc_tipoc' => Yii::t('tipo_cambio', 'Cambioc Tipoc'),
            'venta_tipoc' => Yii::t('tipo_cambio', 'Venta Tipoc'),
            'valorf_tipoc' => Yii::t('tipo_cambio', 'Valorf Tipoc'),
        ];
    }
}
