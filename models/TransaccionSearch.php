<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use app\models\Transaccion;
use yii\data\SqlDataProvider;
use yii\data\ArrayDataProvider;

/**
 * TransaccionSearch represents the model behind the search form of `app\models\Transaccion`.
 */
class TransaccionSearch extends Transaccion
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
    public $saldo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_trans', 'tipo_trans', 'numdoc_trans', 'idrefdoc_trans', 'almacen_trans', 'sucursal_trans', 'usuario_trans', 'status_trans',
                'id_prod', 'saldo'], 'integer'],
            [['codigo_trans', 'fecha_trans', 'obsv_trans', 'ope_trans', 'seriedocref_trans', 'docref_trans',
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
                'saldo'
              ], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    // public function search($params)
    // {
    //     $query = Transaccion::find();
    //
    //     // add conditions that should always apply here
    //
    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //     ]);
    //
    //     $this->load($params);
    //
    //     if (!$this->validate()) {
    //         // uncomment the following line if you do not want to return any records when validation fails
    //         // $query->where('0=1');
    //         return $dataProvider;
    //     }
    //
    //     // grid filtering conditions
    //     $query->andFilterWhere([
    //         'id_trans' => $this->id_trans,
    //         'fecha_trans' => $this->fecha_trans,
    //         'tipo_trans' => $this->tipo_trans,
    //         'numdoc_trans' => $this->numdoc_trans,
    //         'idrefdoc_trans' => $this->idrefdoc_trans,
    //         'almacen_trans' => $this->almacen_trans,
    //         'sucursal_trans' => $this->sucursal_trans,
    //         'usuario_trans' => $this->usuario_trans,
    //         'status_trans' => $this->status_trans,
    //     ]);
    //
    //     $query->andFilterWhere(['like', 'codigo_trans', $this->codigo_trans])
    //         ->andFilterWhere(['like', 'obsv_trans', $this->obsv_trans])
    //         ->andFilterWhere(['like', 'ope_trans', $this->ope_trans])
    //         ->andFilterWhere(['like', 'seriedocref_trans', $this->seriedocref_trans])
    //         ->andFilterWhere(['like', 'docref_trans', $this->docref_trans]);
    //
    //     return $dataProvider;
	// }




    public function search($params)
    {
        $sucursal = Yii::$app->user->identity->profiles->sucursal;
    		$query = new Query;
    		$query->select('id_prod,
    					  cod_prod,
    					  des_prod,
    					  fecha_trans,
    					  docref_trans,
    					  codigo_trans,
    					  ope_trans,
    					  id_tipom,
    					  des_tipom,
    					  id_tipod,
    					  des_tipod,
    					  ingreso_unidades,
    					  moneda,
    					  precio_compra_ext,
    					  precio_compra_soles,
    					  ingreso_valorizados,
    					  salidas_unidades,
    					  tipo,
    					  sucursal_trans')
    		->from(['(
    		select * from salidas_ajustes
    		  union
    		  select * from salidas_documentos
    		  union
    		  select * from salidas_proformas
    		  union
    		  select * from entradas_ajustes
    		  union
    		  select * from entradas_compras
    		  union
    		  select * from entradas_documentos
    		) as sub'])
        ->where(['=','sucursal_trans',$sucursal])
        ->orderBy('fecha_trans asc');

        $id_prod = !empty($params['TransaccionSearch']['id_prod']) ? $params['TransaccionSearch']['id_prod'] : "";
        $fecha_trans = !empty($params['TransaccionSearch']['fecha_trans']) ? $params['TransaccionSearch']['fecha_trans'] : "";
        $fechaDocInicio = "";
        $fechaDocFin = "";

        if ( !empty($id_prod) ) {
          $query->andwhere(['=','id_prod',$id_prod]);
        }

        if ( !empty($fecha_trans) ) {
            $fechaDoc = explode(" - ", $fecha_trans);
            $fechaDocInicio = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[0]))->format('Y-m-d');
            $fechaDocFin = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[1]))->format('Y-m-d');
            $query->andWhere(['between','fecha_trans',$fechaDocInicio,$fechaDocFin]);
        }

        if (!empty($id_prod) || !empty($fecha_trans)) {
          //Subquery fecha minima para stock inicial
          $queryMinFecha = $this->minFecha($id_prod,$fechaDocInicio,$fechaDocFin,$sucursal);
          $minFecha = $queryMinFecha->all();
          $minFecha = $minFecha[0]['minFecha'];

          //Subquery stock inicial
          $querySinicial = $this->stockInicial($id_prod, $minFecha, $sucursal);
                        
          
          //Subquery saldo anterior
          $querySanterior = $this->saldoAnterior($id_prod, $fechaDocInicio, $sucursal);

          $queryPrincipal = new Query();
          $queryPrincipal->select([
                                    'vp.id_prod',
                                    'stock_inicial' => $querySinicial,
                                    'saldo_anterior' => $querySanterior,
                                    'p.stock_prod'
                                  ])
                        ->from(['transaccion t'])
                        ->join('inner join', 'trans_detalle td', 't.id_trans = td.trans_detalle')
                        ->join('inner join', 'producto p', 'p.id_prod = td.prod_detalle')
                        ->join('inner join', 'v_productos vp', 'vp.id_prod = td.prod_detalle')
                        ->where(['=','vp.id_prod',$id_prod])
                        ->andWhere(['=','t.ope_trans','S'])
                        ->andWhere(['=','t.status_trans',1])
                        ->andWhere(['=','t.sucursal_trans',1]);
          
          if ( !empty($fechaDocInicio) && !empty($fechaDocFin) ) {
            $queryMinFecha->andWhere(['between','fecha_trans',$fechaDocInicio,$fechaDocFin]);      
          }

          $queryPrincipal->groupBy('vp.id_prod,vp.stock_prod');                        

          $qryPpal = $queryPrincipal->all();
          // echo $queryPrincipal->createCommand()->sql;
          // var_dump($res,$id_prod,$fecha_trans);exit();
        }


        //echo $query->createCommand()->sql;
        $models = $query->all();

        //var_dump($models);exit();

        $total = 0;
        $data = [];
        foreach ($models as $key => $value) {
          // code...
          $total = $total + floatval($value['ingreso_unidades']) - floatval($value['salidas_unidades']);
          $value['saldo'] = $total;
          $data[ $key ] = $value;
        }

    		$dataProvider = new ArrayDataProvider([
    			'allModels' => $data,
    			'sort'=> [
    						'defaultOrder' => [
    											'fecha_trans'=>SORT_ASC
    										]
    					],
    			'pagination' => false,
    		]);

        //
        //
        // print_r($models);
        // exit();

    		$dataProvider->sort->attributes['fecha_trans'] = [
    		  'asc' => ['fecha_trans' => SORT_ASC],
    		  'desc' => ['fecha_trans' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['docref_trans'] = [
    		  'asc' => ['docref_trans' => SORT_ASC],
    		  'desc' => ['docref_trans' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['codigo_trans'] = [
    		  'asc' => ['codigo_trans' => SORT_ASC],
    		  'desc' => ['codigo_trans' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['ope_trans'] = [
    		  'asc' => ['ope_trans' => SORT_ASC],
    		  'desc' => ['ope_trans' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['des_tipom'] = [
    		  'asc' => ['des_tipom' => SORT_ASC],
    		  'desc' => ['des_tipom' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['des_tipod'] = [
    		  'asc' => ['des_tipod' => SORT_ASC],
    		  'desc' => ['des_tipod' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['ingreso_unidades'] = [
    		  'asc' => ['ingreso_unidades' => SORT_ASC],
    		  'desc' => ['ingreso_unidades' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['moneda'] = [
    		  'asc' => ['moneda' => SORT_ASC],
    		  'desc' => ['moneda' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['precio_compra_ext'] = [
    		  'asc' => ['precio_compra_ext' => SORT_ASC],
    		  'desc' => ['precio_compra_ext' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['precio_compra_soles'] = [
    		  'asc' => ['precio_compra_soles' => SORT_ASC],
    		  'desc' => ['precio_compra_soles' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['ingreso_valorizados'] = [
    		  'asc' => ['ingreso_valorizados' => SORT_ASC],
    		  'desc' => ['ingreso_valorizados' => SORT_DESC],
    		];

    		$dataProvider->sort->attributes['salidas_unidades'] = [
    		  'asc' => ['salidas_unidades' => SORT_ASC],
    		  'desc' => ['salidas_unidades' => SORT_DESC],
    		];

        $dataProvider->sort->attributes['saldo'] = [
          'asc' => ['saldo' => SORT_ASC],
          'desc' => ['saldo' => SORT_DESC],
        ];

    		$this->load($params);
    		//
    		if (!$this->validate() || empty($params) ) {
    		  // uncomment the following line if you do not want to return any records when validation fails
    		  $query->where('0=1');
    		  return $dataProvider;
    		}

    		//Condicional para la fecha, verifica si es rango o solo una fecha
    		if ( !empty($this->fecha_trans) ) {
        		$fechaDoc = explode(" - ", $this->fecha_trans);
        		$fechaDocInicio = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[0]))->format('Y-m-d');
        		$fechaDocFin = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[1]))->format('Y-m-d');
        		$query->andFilterWhere(['between', 'fecha_trans', $fechaDocInicio, $fechaDocFin]);
    		}


    		//grid filtering conditions
    		$query->andFilterWhere([
    			'id_prod' => $this->id_prod,
    		]);

    		return $dataProvider;
    }

    protected function minFecha($id_prod = null, $fechaDocInicio = null , $fechaDocFin = null, $sucursal)
    {
      $queryMinFecha = new Query();
      $queryMinFecha->select(['min(fecha_trans) minFecha'])
                    ->from(['transaccion'])
                    ->join('INNER JOIN', 'trans_detalle', 'id_trans = trans_detalle')
                    ->where(["=","sucursal_trans",$sucursal])
                    ->andWhere(['=','status_trans','1'])
                    ->andWhere(['=','ope_trans','E']);

      if ( !empty($id_prod) ) {
        $queryMinFecha->andWhere(['=','prod_detalle',$id_prod]);
      }

      if ( !empty($fechaDocInicio) && !empty($fechaDocFin) ) {
        $queryMinFecha->andWhere(['between','fecha_trans',$fechaDocInicio,$fechaDocFin]);      
      }

      return $queryMinFecha;
    }

    protected function stockInicial($id_prod = null, $minFecha, $sucursal)
    {
      $querySinicial = new Query();
      $querySinicial->select([ 'coalesce(sum(cant_detalle),0) as stock_inicial'])
                    ->from(['transaccion'])
                    ->join('INNER JOIN', 'trans_detalle', 'id_trans = trans_detalle')
                    ->where(["=","sucursal_trans",$sucursal])
                    ->andWhere(['=','status_trans','1'])
                    ->andWhere(['=','ope_trans','S'])
                    ->andWhere(['<','fecha_trans', $minFecha]);
                    
      if ( !empty($id_prod) ) {
        $querySinicial->andWhere(['=','prod_detalle',$id_prod]);
      }

      return $querySinicial;
    }

    protected function saldoAnterior($id_prod, $minFecha, $sucursal)
    {
      $querySanterior = new Query();
      $querySanterior->select([ 'coalesce(sum(cant_detalle),0) as saldo_anterior'])
                        ->from(['transaccion'])
                        ->join('INNER JOIN', 'trans_detalle', 'id_trans = trans_detalle')
                        ->where(["=","sucursal_trans",$sucursal])
                        ->andWhere(['=','status_trans','1'])       
                        ->andWhere(['<','fecha_trans', $minFecha]);

      if ( !empty($id_prod) ) {
        $querySanterior->andWhere(['=','prod_detalle',$id_prod]);
      }

      return $querySanterior;
    }
}
