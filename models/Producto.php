<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id_prod ID UNICO
 * @property string $cod_prod CODIGO PRODUCTO
 * @property string $des_prod DESCRIPCION PRODUCTO
 * @property int $tipo_prod TIPO PRODUCTO
 * @property int $umed_prod UNIDAD DE MEDIDA PRODUCTO
 * @property int $contenido_prod CONTENIDO PRODUCTO
 * @property int $exctoigv_prod EXCENTO IGV (IVA) PRODUCTO
 * @property int $compra_prod PRODUCTO PARA COMPRA
 * @property int $venta_prod PRODUCTO PARA VENTA
 * @property int $stockini_prod STOCK INICIAL PRODUCTO
 * @property int $stockmax_prod STOCK MAXIMO PRODUCTO
 * @property int $stockmin_prod STOCK MINIMO PRODUCTO
 * @property int $status_prod ESTATUS PRODUCTO
 * @property int $sucursal_prod SUCURSAL PRODUCTO
 *
 * @property TipoProducto $tipoProd
 * @property UnidadMedida $umedProd
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
            [['cod_prod', 'des_prod', 'tipo_prod', 'umed_prod', 'contenido_prod', 'status_prod', ], 'required'],
            [['tipo_prod', 'umed_prod', 'contenido_prod', 'exctoigv_prod', 'compra_prod', 'venta_prod', 'stockini_prod', 'stockmax_prod', 'stockmin_prod', 'status_prod', 'sucursal_prod'], 'integer'],
            [['cod_prod'], 'string', 'max' => 25],
            [['codfab_prod'], 'string', 'max' => 45],
            [['des_prod'], 'string', 'max' => 70],
            [['cod_prod'], 'unique'],
            [['tipo_prod'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProducto::className(), 'targetAttribute' => ['tipo_prod' => 'id_tpdcto']],
            [['umed_prod'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadMedida::className(), 'targetAttribute' => ['umed_prod' => 'id_und']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prod' => Yii::t('producto', 'Id'),
            'cod_prod' => Yii::t('producto', 'Code'),
            'codfab_prod' => Yii::t('producto', 'Factory code'),
            'des_prod' => Yii::t('producto', 'Description'),
            'tipo_prod' => Yii::t('tipo_producto', 'Product type'),
            'umed_prod' => Yii::t('unidad_medida', 'Unit of measurement'),
            'contenido_prod' => Yii::t('producto', 'Content'),
            'exctoigv_prod' => Yii::t('producto', 'IGV exemption'),
            'compra_prod' => Yii::t('producto', 'Product for purchase'),
            'venta_prod' => Yii::t('producto', 'Product for sale'),
            'stockini_prod' => Yii::t('producto', 'Initial stock'),
            'stockmax_prod' => Yii::t('producto', 'Max Stock'),
            'stockmin_prod' => Yii::t('producto', 'Min Stock'),
            'status_prod' => Yii::t('producto', 'Status'),
            'sucursal_prod' => Yii::t('producto', 'Sucursal Prod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProd()
    {
        return $this->hasOne(TipoProducto::className(), ['id_tpdcto' => 'tipo_prod']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUmedProd()
    {
        return $this->hasOne(UnidadMedida::className(), ['id_und' => 'umed_prod']);
    }

    public function getListas()
   {
       return $this->hasMany(ListaPrecios::className(), ['prod_lista' => 'id_prod']);
   }
}
