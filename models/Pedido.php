<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id_pedido ID UNICO
 * @property string $cod_pedido CODIGO PEDIDO
 * @property string $fecha_pedido FECHA PEDIDO
 * @property int $clte_pedido CLIENTE PEDIDO
 * @property int $vend_pedido VENDEDOR PEDIDO
 * @property int $moneda_pedido MONEDA PEDIDO
 * @property int $almacen_pedido ALMACEN PEDIDO
 * @property int $usuario_pedido USUARIO PEDIDO
 * @property int $estatus_pedido ESTATUS PEDIDO
 * @property int $sucursal_pedido SUCURSAL PEDIDO
 *
 * @property Cliente $cltePedido
 * @property Vendedor $vendPedido
 * @property Moneda $monedaPedido
 */
class Pedido extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVO = 1;
    const STATUS_INACTIVO = 0;
    const PEDIDO = 'NP';
    const PROFORMA = 'PR';
    const COTIZACION = 'CT';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_pedido', 'fecha_pedido', 'clte_pedido', 'vend_pedido', 'moneda_pedido', 'almacen_pedido', 'condp_pedido','tipo_pedido'], 'required'],
            [['fecha_pedido'], 'safe'],
            [['clte_pedido', 'vend_pedido', 'moneda_pedido', 'almacen_pedido', 'usuario_pedido', 'condp_pedido', 'estatus_pedido', 'sucursal_pedido'], 'integer'],
            [['cod_pedido'], 'string', 'max' => 10],
            [['nrodoc_pedido'], 'string', 'max' => 12],
            [['tipo_pedido'], 'string', 'max' => 2],
            [['cod_pedido'], 'unique', 'targetAttribute' => ['cod_pedido','tipo_pedido']],
            [['clte_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['clte_pedido' => 'id_clte']],
            [['vend_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Vendedor::className(), 'targetAttribute' => ['vend_pedido' => 'id_vendedor']],
            [['moneda_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Moneda::className(), 'targetAttribute' => ['moneda_pedido' => 'id_moneda']],
            [['condp_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => CondPago::className(), 'targetAttribute' => ['condp_pedido' => 'id_condp']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pedido' => Yii::t('pedido', 'Id'),
            'cod_pedido' => Yii::t('pedido', 'Code'),
            'nrodoc_pedido' => Yii::t('pedido', 'Document'),
            'fecha_pedido' => Yii::t('app', 'Date'),
            'clte_pedido' => Yii::t('cliente', 'Customer'),
            'vend_pedido' => Yii::t('vendedor', 'Seller'),
            'moneda_pedido' => Yii::t('moneda', 'Currency'),
            'almacen_pedido' => Yii::t('almacen', 'Warehouse'),
            'condp_pedido' => Yii::t('condicionp', 'Payment condition'),
            'tipo_pedido' => Yii::t('pedido', 'Type'),
            'usuario_pedido' => Yii::t('pedido', 'Usuario Pedido'),
            'estatus_pedido' => Yii::t('pedido', 'Estatus Pedido'),
            'sucursal_pedido' => Yii::t('pedido', 'Sucursal Pedido'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacenPedido()
    {
        return $this->hasOne(Almacen::className(), ['id_almacen' => 'almacen_pedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCltePedido()
    {
        return $this->hasOne(Cliente::className(), ['id_clte' => 'clte_pedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendPedido()
    {
        return $this->hasOne(Vendedor::className(), ['id_vendedor' => 'vend_pedido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonedaPedido()
    {
        return $this->hasOne(Moneda::className(), ['id_moneda' => 'moneda_pedido']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondpPedido()
    {
        return $this->hasOne(CondPago::className(), ['id_condp' => 'condp_pedido']);
    }

    public function getDetalles()
    {
       return $this->hasMany(PedidoDetalle::className(), ['pedido_pdetalle' => 'id_pedido']);
    }

    public function sumChildTotal()
    {
        $total = 0;
        
        foreach( $this->detalles as $value){
          $total += $value->total_pdetalle;
        }

        return $total;
    }
}
