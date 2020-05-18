<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sucursal".
 *
 * @property int $id_suc ID UNICO
 * @property string $nombre_suc NOMBRE SUCURSAL
 * @property int $estatus_suc ESTATUS SUCURSAL
 * @property int $empresa_suc EMPRESA  DE LA SUCURSAL
 *
 * @property Cliente[] $clientes
 * @property Producto[] $productos
 * @property Vendedor[] $vendedors
 * @property Zona[] $zonas
 */
class Sucursal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sucursal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_suc','impuesto_suc','estatus_suc'], 'required'],
            [['id_suc', 'estatus_suc', 'empresa_suc'], 'integer'],
            [['impuesto_suc'], 'number'],
            [['nombre_suc'], 'string', 'max' => 50],
            [['id_suc'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_suc' => Yii::t('sucursal', 'Id'),
            'nombre_suc' => Yii::t('sucursal', 'Name'),
            'estatus_suc' => Yii::t('sucursal', 'Status'),
            'impuesto_suc' => Yii::t('sucursal', 'Taxes'),
            'empresa_suc' => Yii::t('sucursal', 'Company'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['sucursal_clte' => 'id_suc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['sucursal_pdcto' => 'id_suc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedors()
    {
        return $this->hasMany(Vendedor::className(), ['sucursal_vend' => 'id_suc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonas()
    {
        return $this->hasMany(Zona::className(), ['sucursal_zona' => 'id_suc']);
    }

    /*
    Obtiene las sucursales de una empresa
    */
    public static function getSucursalesList( $empresa ) 
    {
      $empresa = (int) $empresa;
      $sucursales = self::find()->where('estatus_suc = 1 and empresa_suc = :empresa',[ ":empresa" => $empresa])
      ->orderBy('nombre_suc')
      ->all();

      return ArrayHelper::map($sucursales,'id_suc','nombre_suc');
    }
}
