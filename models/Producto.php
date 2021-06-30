<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
	const STATUS_PROD_ACTIVE = 1;
	const STATUS_PROD_INACTIVE = 0;
    public $image;
	/**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
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
            [['cod_prod', 'des_prod', 'tipo_prod', 'umed_prod', 'contenido_prod', 'status_prod', 'marca_prod' ], 'required'],
            [['tipo_prod', 'umed_prod', 'contenido_prod', 'marca_prod', 'exctoigv_prod', 'compra_prod', 'venta_prod', 'stockini_prod', 'stockmax_prod', 'stockmin_prod', 'status_prod', 'sucursal_prod'], 'integer'],
            [['cod_prod'], 'string', 'max' => 25],
            [['codfab_prod'], 'string', 'max' => 45],
            [['des_prod'], 'string', 'max' => 70],
            [['image_prod'], 'string', 'max' => 255],
            [['deslarg_prod'], 'string'],
            [['cod_prod'], 'unique'],
            [['compra_prod','venta_prod'], 'default', 'value' => 1],
            [['stockmin_prod','stockmax_prod'], 'default', 'value' => 0],
            [['tipo_prod'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProducto::className(), 'targetAttribute' => ['tipo_prod' => 'id_tpdcto']],
            [['umed_prod'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadMedida::className(), 'targetAttribute' => ['umed_prod' => 'id_und']],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prod' => Yii::t('producto', 'Id'),            
            'image' => Yii::t('producto', 'Imagen'),            
            'cod_prod' => Yii::t('producto', 'Code'),
            'codfab_prod' => Yii::t('producto', 'Factory code'),
            'des_prod' => Yii::t('producto', 'Description'),
            'deslarg_prod' => Yii::t('producto', 'Large description'),
            'tipo_prod' => Yii::t('tipo_producto', 'Product type'),
            'umed_prod' => Yii::t('unidad_medida', 'Unit of measurement'),
            'contenido_prod' => Yii::t('producto', 'Content'),
            'marca_prod' => Yii::t('marca', 'Make'),
            'exctoigv_prod' => Yii::t('producto', 'IGV exemption'),
            'compra_prod' => Yii::t('producto', 'Product for purchase'),
            'venta_prod' => Yii::t('producto', 'Product for sale'),
            'stockini_prod' => Yii::t('producto', 'Initial stock'),
            'stockmax_prod' => Yii::t('producto', 'Max Stock'),
            'stockmin_prod' => Yii::t('producto', 'Min Stock'),
            'image_prod' => Yii::t('producto', 'Image'),
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
    public function getMarca()
    {
        return $this->hasOne(Marca::className(), ['id_marca' => 'marca_prod']);
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

    public static function getProductoList()
    {

        $productos = Producto::find()
                        ->select(['id_prod','concat(rtrim(ltrim(cod_prod)),\' - \',rtrim(ltrim(des_prod))) as des_prod'])
                        ->where(['status_prod' => Producto::STATUS_PROD_ACTIVE])->all();

        return ArrayHelper::map($productos,'id_prod','des_prod');
    }
}
