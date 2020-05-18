<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [[ 'nombre_clte', 'tipoid_clte','direcc_clte','vendedor_clte', 'estatus_ctle','lista_clte', 'condp_clte', 'pais_cte', 'depto_cte', 'provi_cte', 'dtto_clte'], 'required'],
            [['direcc_clte'], 'string'],
            [['pais_cte', 'tipoid_clte','depto_cte', 'provi_cte', 'dtto_clte', 'vendedor_clte', 'estatus_ctle', 'lista_clte','condp_clte', 'sucursal_clte'], 'integer'],
            [['dni_clte', 'ruc_clte'], 'string', 'max' => 20],
            [['nombre_clte'], 'string', 'max' => 150],
            [['tlf_ctle'], 'string', 'max' => 100],
            [['vendedor_clte'], 'exist', 'skipOnError' => true, 'targetClass' => Vendedor::className(), 'targetAttribute' => ['vendedor_clte' => 'id_vendedor']],
            [['pais_cte'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_cte' => 'id_pais']],
            [['provi_cte'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provi_cte' => 'id_prov']],
            [['depto_cte'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['depto_cte' => 'id_depto']],
            [['dtto_clte'], 'exist', 'skipOnError' => true, 'targetClass' => Distrito::className(), 'targetAttribute' => ['dtto_clte' => 'id_dtto']],
            [['condp_clte'], 'exist', 'skipOnError' => true, 'targetClass' => CondPago::className(), 'targetAttribute' => ['condp_clte' => 'id_condp']],
            [['lista_clte'], 'exist', 'skipOnError' => true, 'targetClass' => TipoListap::className(), 'targetAttribute' => ['lista_clte' => 'id_lista']],
            [['tipoid_clte'], 'exist', 'skipOnError' => true, 'targetClass' => TipoIdentificacion::className(), 'targetAttribute' => ['tipoid_clte' => 'id_tipoi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_clte' => Yii::t('cliente', 'Id'),
            'tipoid_clte' => Yii::t('tipo_identificacion', 'Id type'),
            'dni_clte' => Yii::t('cliente', 'Dni'),
            'ruc_clte' => Yii::t('cliente', 'Ruc'),
            'nombre_clte' => Yii::t('cliente', 'Name'),
            'direcc_clte' => Yii::t('cliente', 'Address'),
            'pais_cte' => Yii::t('pais', 'Country'),
            'depto_cte' => Yii::t('departamento', 'Department / County / Municipality'),
            'provi_cte' => Yii::t('provincia', 'Estate / Province'),
            'dtto_clte' => Yii::t('distrito', 'District / Parish'),
            'tlf_ctle' => Yii::t('cliente', 'Phone'),
            'vendedor_clte' => Yii::t('vendedor', 'Seller'),
            'estatus_ctle' => Yii::t('cliente', 'Status'),
            'condp_clte' => Yii::t('condicionp', 'Payment condition'),
            'lista_clte' => Yii::t('tipo_listap','List price type'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaisClte()
    {
        return $this->hasOne(Pais::className(), ['id_pais' => 'pais_cte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvClte()
    {
        return $this->hasOne(Provincia::className(), ['id_prov' => 'provi_cte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeptoClte()
    {
        return $this->hasOne(Departamento::className(), ['id_depto' => 'depto_cte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDttoClte()
    {
        return $this->hasOne(Distrito::className(), ['id_dtto' => 'dtto_clte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondpClte()
    {
        return $this->hasOne(CondPago::className(), ['id_condp' => 'condp_clte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoListap()
    {
        return $this->hasOne(TipoListap::className(), ['id_lista' => 'lista_clte']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoIdentificacion()
    {
        return $this->hasOne(TipoIdentificacion::className(), ['id_tipoi' => 'tipoid_clte']);
    }

    public static function getClienteList()
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;

      $condiciones = Cliente::find()
                     ->where('estatus_ctle = :status and sucursal_clte = :sucursal',[':status' => 1, ':sucursal' => $sucursal])
                     ->orderBy('nombre_clte')
                     ->all();
      return ArrayHelper::map( $condiciones, 'id_clte', 'nombre_clte');
    }
}
