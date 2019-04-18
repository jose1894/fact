<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id_clte ID UNICO
 * @property string $dni_clte DNI CLIENTE
 * @property string $ruc_clte RUC CLIENTE
 * @property string $nombre_clte NOMBRE CLIENTE
 * @property string $direcc_clte DIRECCION CLIENTE
 * @property int $pais_cte PAIS CLIENTE
 * @property int $depto_cte DEPARTAMENTO CLIENTE
 * @property int $provi_cte PROVINCIA CLIENTE
 * @property int $dtto_clte DISTRITO CLIENTE
 * @property string $tlf_ctle TELEFONO CLIENTE
 * @property int $vendedor_clte VENDEDOR CLIENTE
 * @property int $estatus_ctle ESTATUS CLIENTE
 * @property int $condp_clte CONDICION DE PAGO
 * @property int $sucursal_clte
 *
 * @property Vendedor $vendedorClte
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dni_clte', 'ruc_clte', 'nombre_clte', 'direcc_clte', 'pais_cte', 'depto_cte', 'provi_cte', 'dtto_clte', 'tlf_ctle', 'vendedor_clte', 'estatus_ctle', 'condp_clte', 'sucursal_clte'], 'required'],
            [['direcc_clte'], 'string'],
            [['pais_cte', 'depto_cte', 'provi_cte', 'dtto_clte', 'vendedor_clte', 'estatus_ctle', 'condp_clte', 'sucursal_clte'], 'integer'],
            [['dni_clte', 'ruc_clte'], 'string', 'max' => 20],
            [['nombre_clte'], 'string', 'max' => 150],
            [['tlf_ctle'], 'string', 'max' => 100],
            [['vendedor_clte'], 'exist', 'skipOnError' => true, 'targetClass' => Vendedor::className(), 'targetAttribute' => ['vendedor_clte' => 'id_vendedor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_clte' => Yii::t('cliente', 'Id Clte'),
            'dni_clte' => Yii::t('cliente', 'Dni Clte'),
            'ruc_clte' => Yii::t('cliente', 'Ruc Clte'),
            'nombre_clte' => Yii::t('cliente', 'Nombre Clte'),
            'direcc_clte' => Yii::t('cliente', 'Direcc Clte'),
            'pais_cte' => Yii::t('cliente', 'Pais Cte'),
            'depto_cte' => Yii::t('cliente', 'Depto Cte'),
            'provi_cte' => Yii::t('cliente', 'Provi Cte'),
            'dtto_clte' => Yii::t('cliente', 'Dtto Clte'),
            'tlf_ctle' => Yii::t('cliente', 'Tlf Ctle'),
            'vendedor_clte' => Yii::t('cliente', 'Vendedor Clte'),
            'estatus_ctle' => Yii::t('cliente', 'Estatus Ctle'),
            'condp_clte' => Yii::t('cliente', 'Condp Clte'),
            'sucursal_clte' => Yii::t('cliente', 'Sucursal Clte'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedorClte()
    {
        return $this->hasOne(Vendedor::className(), ['id_vendedor' => 'vendedor_clte']);
    }
}
