<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id_pdcto ID UNICO
 * @property string $cod_pdcto CODIGO PRODUCTO
 * @property string $des_pdcto DESCIPCION DE PRODUCTO
 * @property int $tipo_pdcto TIPO PRODUCTO
 * @property int $umed_pdcto UNIDAD MEDIDA PRODUCTO
 * @property int $status_pdcto ESTATUS PRODUCTO
 * @property int $sucursal_pdcto SUCURSAL PRODUCTO
 *
 * @property TipoProducto $tipoPdcto
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_pdcto', 'des_pdcto', 'tipo_pdcto', 'umed_pdcto', 'status_pdcto', 'sucursal_pdcto'], 'required'],
            [['tipo_pdcto', 'umed_pdcto', 'status_pdcto', 'sucursal_pdcto'], 'integer'],
            [['cod_pdcto'], 'string', 'max' => 30],
            [['des_pdcto'], 'string', 'max' => 255],
            [['cod_pdcto'], 'unique'],
            [['tipo_pdcto'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProducto::className(), 'targetAttribute' => ['tipo_pdcto' => 'id_tpdcto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pdcto' => Yii::t('sucursal', 'Id Pdcto'),
            'cod_pdcto' => Yii::t('sucursal', 'Cod Pdcto'),
            'des_pdcto' => Yii::t('sucursal', 'Des Pdcto'),
            'tipo_pdcto' => Yii::t('sucursal', 'Tipo Pdcto'),
            'umed_pdcto' => Yii::t('sucursal', 'Umed Pdcto'),
            'status_pdcto' => Yii::t('sucursal', 'Status Pdcto'),
            'sucursal_pdcto' => Yii::t('sucursal', 'Sucursal Pdcto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPdcto()
    {
        return $this->hasOne(TipoProducto::className(), ['id_tpdcto' => 'tipo_pdcto']);
    }
}
