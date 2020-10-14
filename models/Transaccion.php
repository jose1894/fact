<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaccion".
 *
 * @property int $id_trans ID UNICO
 * @property string $codigo_trans CODIGO TRANSACCION
 * @property string|null $fecha_trans FECHA TRANSACCION
 * @property string|null $obsv_trans OBSERVACIONES TRANSACCION
 * @property int $tipo_trans TIPO TRANSACCION
 * @property string $ope_trans OPERACION TRANSACCION
 * @property int|null $numdoc_trans NUMERACION DEL DOCUMENTO QUE GENERA LA TRANSACCION
 * @property int|null $idrefdoc_trans ID DOCUMENTO REFERENCIA TRANSACCION
 * @property string|null $seriedocref_trans SERIE DOC REFERENCIA TRANSACCION
 * @property string|null $docref_trans DOCUMENTO REFERENCIA TRANSACCION
 * @property int $almacen_trans ALMACEN TRANSACCION
 * @property int $sucursal_trans SUCURSAL TRANSACCION
 * @property int $usuario_trans USUARIO TRANSACCION
 * @property int $status_trans ESTATUS TRANSACCION 0=NO APROBADA, 1 = APROBADA, 2 = ANULADA
 *
 * @property TransDetalle[] $transDetalles
 * @property TipoMovimiento $tipoTrans
 * @property Almacen $almacenTrans
 */
class Transaccion extends \yii\db\ActiveRecord
{
    public $id_prod;
    public $cod_prod;
    public $des_prod;
    public $fecha_trans;
    public $docref_trans;
    public $codigo_trans;
    public $ope_trans;
    public $id_tipom;
    public $des_tipom;
    public $id_tipod;
    public $des_tipod;
    public $ingreso_unidades;
    public $moneda;
    public $precio_compra_ext;
    public $precio_compra_soles;
    public $ingreso_valorizados;
    public $salidas_unidades;
    public $tipo;
    public $sucursal_trans;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaccion';
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
            [['codigo_trans', 'ope_trans', 'almacen_trans'], 'required'],
            [
				[
					'fecha_trans',
					'id_prod',
					'cod_prod',
					'des_prod',
					'fecha_trans',
					'docref_trans',
					'codigo_trans',
					'ope_trans',
					'id_tipom',
					'des_tipom',
					'id_tipod',
					'des_tipod',
					'ingreso_unidades',
					'moneda',
					'precio_compra_ext',
					'precio_compra_soles',
					'ingreso_valorizados',
					'salidas_unidades',
					'tipo',
					'sucursal_trans',
				],
				'safe'
			],
            [['obsv_trans'], 'string'],
            [['tipo_trans', 'numdoc_trans', 'idrefdoc_trans', 'almacen_trans', 'sucursal_trans', 'usuario_trans', 'status_trans'], 'integer'],
            [['codigo_trans', 'docref_trans'], 'string', 'max' => 10],
            [['ope_trans'], 'string', 'max' => 1],
            [['seriedocref_trans'], 'string', 'max' => 4],
            [['codigo_trans', 'tipo_trans'], 'unique', 'targetAttribute' => ['codigo_trans', 'tipo_trans']],
            [['tipo_trans'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMovimiento::className(), 'targetAttribute' => ['tipo_trans' => 'id_tipom']],
            [['almacen_trans'], 'exist', 'skipOnError' => true, 'targetClass' => Almacen::className(), 'targetAttribute' => ['almacen_trans' => 'id_almacen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
			'id_prod' => Yii::t('producto','Product'),
			'docref_trans' => Yii::t('cliente', 'Customer'),
            'fecha_trans' => Yii::t('app', 'Date'),
            /*'id_trans' => Yii::t('app', 'Id Trans'),
            'codigo_trans' => Yii::t('app', 'Codigo Trans'),
            'obsv_trans' => Yii::t('app', 'Obsv Trans'),
            'tipo_trans' => Yii::t('app', 'Tipo Trans'),
            'ope_trans' => Yii::t('app', 'Ope Trans'),
            'numdoc_trans' => Yii::t('app', 'Numdoc Trans'),
            'idrefdoc_trans' => Yii::t('app', 'Idrefdoc Trans'),
            'seriedocref_trans' => Yii::t('app', 'Seriedocref Trans'),
            'docref_trans' => Yii::t('app', 'Docref Trans'),
            'almacen_trans' => Yii::t('app', 'Almacen Trans'),
            'sucursal_trans' => Yii::t('app', 'Sucursal Trans'),
            'usuario_trans' => Yii::t('app', 'Usuario Trans'),
            'status_trans' => Yii::t('app', 'Status Trans'),
			'docref_trans' => Yii::t('cliente', 'Customer'),*/
        ];
		
		/*return [
			'docref_trans' => Yii::t('cliente', 'Customer'),
			'id_prod' => Yii::t('producto','Product'),
			'cod_prod' => Yii::t('producto','Product code'),
			'des_prod' => Yii::t('producto','Description'),
			'id_trans' => Yii::t('app', 'Id Trans'),
            'codigo_trans' => Yii::t('app', 'Codigo Trans'),
            'fecha_trans' => Yii::t('app', 'Date'),
            'obsv_trans' => Yii::t('app', 'Comments'),
            'tipo_trans' => Yii::t('app', 'Type'),
            'ope_trans' => Yii::t('app', 'Operation'),
            'numdoc_trans' => Yii::t('documento', 'Document'),
            'idrefdoc_trans' => Yii::t('app', 'Idrefdoc Trans'),
            'seriedocref_trans' => Yii::t('app', 'Seriedocref Trans'),            
            'almacen_trans' => Yii::t('almacen', 'Warehouse'),
            'sucursal_trans' => Yii::t('app', 'Sucursal Trans'),
            'usuario_trans' => Yii::t('app', 'Usuario Trans'),
            'status_trans' => Yii::t('app', 'Status Trans'),
		];*/
			

    }

    /**
     * Gets query for [[TransDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransDetalles()
    {
        return $this->hasMany(TransDetalle::className(), ['trans_detalle' => 'id_trans']);
    }

    /**
     * Gets query for [[TipoTrans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoTrans()
    {
        return $this->hasOne(TipoMovimiento::className(), ['id_tipom' => 'tipo_trans']);
    }

    /**
     * Gets query for [[AlmacenTrans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlmacenTrans()
    {
        return $this->hasOne(Almacen::className(), ['id_almacen' => 'almacen_trans']);
    }

    public static function getTotal($provider)
    {
        $total = 0;
        foreach ($provider as $item) {
            $total = $total - $item['salidas_unidades'] + $item['ingreso_unidades'];
        }
        return $total;  
    }
}
