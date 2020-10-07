<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "compra".
 *
 * @property int $id_compra ID UNICO
 * @property string $cod_compra CODIGO COMPRA
 * @property string $fecha_compra FECHA COMPRA
 * @property int $provee_compra PROVEEDOR COMPRA
 * @property int $moneda_compra MONEDA COMPRA
 * @property int $condp_compra CONDICION PAGO COMPRA
 * @property int $usuario_compra USUARIO COMPRA
 * @property int $estatus_compra ESTATUS COMPRA
 * @property string $edicion_compra EDICION COMPRA
 * @property string $nrodoc_compra NRO DOCUMENTO COMPRA
 * @property int $sucursal_compra SUCURSAL COMPRA
 *
 * @property Proveedor $proveeCompra
 * @property Moneda $monedaCompra
 * @property CondPago $condpCompra
 * @property CompraDetalle[] $compraDetalles
 */
class Compra extends \yii\db\ActiveRecord
{
    const ORDEN_COMPRA = 'OC';
    const TIPO_MOVIMIENTO = 3;
    const STATUS_ACTIVE = 1;
    const STATUS_APPROVED = 2;
    const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compra';
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
            [['cod_compra', 'fecha_compra', 'provee_compra', 'moneda_compra', 'condp_compra', 'usuario_compra'], 'required'],
            [['fecha_compra'], 'safe'],
            [['provee_compra', 'moneda_compra', 'condp_compra', 'excento_compra', 'usuario_compra', 'estatus_compra', 'sucursal_compra'], 'integer'],
            [['cod_compra'], 'string', 'max' => 10],
            [['edicion_compra'], 'string', 'max' => 1],
            [['nrodoc_compra'], 'string', 'max' => 25],
            [['cod_compra'], 'unique'],
            [['excento_compra', 'afectaalm_compra'], 'default', 'value'=> 0],
            [['provee_compra'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['provee_compra' => 'id_prove']],
            [['moneda_compra'], 'exist', 'skipOnError' => true, 'targetClass' => Moneda::className(), 'targetAttribute' => ['moneda_compra' => 'id_moneda']],
            [['condp_compra'], 'exist', 'skipOnError' => true, 'targetClass' => CondPago::className(), 'targetAttribute' => ['condp_compra' => 'id_condp']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_compra' => Yii::t('compra', 'Id'),
            'cod_compra' => Yii::t('compra', 'Code'),
            'fecha_compra' => Yii::t('compra', 'Date'),
            'provee_compra' => Yii::t('proveedor', 'Supplier'),
            'moneda_compra' => Yii::t('moneda', 'Currency'),
            'condp_compra' => Yii::t('condicionp', 'Payment condition'),
            'usuario_compra' => Yii::t('compra', 'Usuario Compra'),
            'estatus_compra' => Yii::t('compra', 'Estatus Compra'),
            'edicion_compra' => Yii::t('compra', 'Edicion Compra'),
            'nrodoc_compra' => Yii::t('compra', 'Nro. Doc'),
            'sucursal_compra' => Yii::t('compra', 'Sucursal Compra'),
            'excento_compra' => Yii::t('app','Tax exemption'),
            'afectaalm_compra' => Yii::t('app','Affect warehouse'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveeCompra()
    {
        return $this->hasOne(Proveedor::className(), ['id_prove' => 'provee_compra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonedaCompra()
    {
        return $this->hasOne(Moneda::className(), ['id_moneda' => 'moneda_compra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondpCompra()
    {
        return $this->hasOne(CondPago::className(), ['id_condp' => 'condp_compra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalles()
    {
        return $this->hasMany(CompraDetalle::className(), ['compra_cdetalle' => 'id_compra']);
    }

    public static function getCompras()
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

        $compras = self::find()
            ->select(['id_compra',"concat(fecha_compra,' | ',cod_compra) cod_compra"])
            ->where('estatus_compra = :status and sucursal_compra = :sucursal AND afectaalm_compra = 1',[':status' => self::STATUS_INACTIVE, ':sucursal' => $sucursal])
            ->orderBy('cod_compra')
            ->all();

        foreach ($compras as $key => $value) {
            $return[$key]['id_compra'] = $value->id_compra;
            $return[$key]['cod_compra'] = $value->cod_compra;

            foreach ( $value->detalles as $key1 => $value1) {
                $return[$key]['details'][$key1]['id_prod'] = $value1->prod_cdetalle;
                $return[$key]['details'][$key1]['des_prod'] = $value1->prodCdetalle->cod_prod.' '.$value1->prodCdetalle->des_prod.' - '.
                                                              $value1->prodCdetalle->umedProd->des_und;
                $return[$key]['details'][$key1]['cant_detalle'] = $value1->cant_cdetalle;
            }
        }
        return $return;
    }
}
