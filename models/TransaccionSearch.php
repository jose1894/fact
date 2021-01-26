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
    public $kardex = false;
    public $inventory = false;
    public $tipo_prod;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_trans', 'tipo_trans', 'numdoc_trans', 'idrefdoc_trans', 'almacen_trans', 'sucursal_trans', 'status_trans',
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
                'precio',
                'salidas_unidades',
                'tipo',
                'sucursal_trans',
                'saldo',
                'kardex',
                'tipo_prod'
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

    public function search($params)
    {
        if ( $this->kardex ) {
          return $this->searchKardex( $params );
        }

        if ( $this->inventory ) {
          return $this->searchInventory( $params );
        }

    }

    private function searchInventory( $params = [])
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;
      $query = new Query;
      $query->select('
              id_prod,
              cod_prod,
              des_prod,
              desc_tpdcto,
              tipo_prod,
              stock_prod_bruto as stock_total,
              stock_asignado,
              stock_prod stock_disponible
            ')
      ->from(['v_productos'])
      ->join('inner join','tipo_producto','id_tpdcto = tipo_prod and sucursal_prod = sucursal_tpdcto')
      ->where(['=','sucursal_prod',$sucursal]);


      $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => false,
      ]);

      $dataProvider->sort->attributes['cod_prod'] = [
        'asc' => ['cod_prod' => SORT_ASC],
        'desc' => ['cod_prod' => SORT_DESC],
      ];

      $dataProvider->sort->attributes['des_prod'] = [
        'asc' => ['des_prod' => SORT_ASC],
        'desc' => ['des_prod' => SORT_DESC],
      ];

      $dataProvider->sort->attributes['tipo_prod'] = [
        'asc' => ['tipo_prod' => SORT_ASC],
        'desc' => ['tipo_prod' => SORT_DESC],
      ];

      $dataProvider->sort->attributes['stock_disponible'] = [
        'asc' => ['stock_disponible' => SORT_ASC],
        'desc' => ['stock_disponible' => SORT_DESC],
      ];

      $dataProvider->sort->attributes['stock_asignado'] = [
        'asc' => ['stock_asignado' => SORT_ASC],
        'desc' => ['stock_asignado' => SORT_DESC],
      ];

      $dataProvider->sort->attributes['stock_total'] = [
        'asc' => ['stock_total' => SORT_ASC],
        'desc' => ['stock_total' => SORT_DESC],
      ];

      $this->load($params);

      if (!$this->validate()) {
          // uncomment the following line if you do not want to return any records when validation fails
          $query->where('0=1');
          return $dataProvider;
      }

      $query->andFilterWhere(['=', 'id_prod', $this->id_prod])
              ->andFilterWhere(['like', 'des_prod', $this->des_prod])
              ->andFilterWhere(['=', 'tipo_prod', $this->tipo_prod]);

      return $dataProvider;
    }


    private function searchKardex( $params = [])
    {
      $sucursal = Yii::$app->user->identity->profiles->sucursal;
      $id_prod = !empty($params['TransaccionSearch']['id_prod']) ? $params['TransaccionSearch']['id_prod'] : "";
      $fecha_trans = !empty($params['TransaccionSearch']['fecha_trans']) ? $params['TransaccionSearch']['fecha_trans'] : "";
      $fechaDocInicio = "";
      $fechaDocFin = "";

      if ( !empty($fecha_trans) ) {
          $fechaDoc = explode(" - ", $fecha_trans);
          $fechaDocInicio = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[0]))->format('Y-m-d');
          $fechaDocFin = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[1]))->format('Y-m-d');
      }

      $qrySelect1 ='id_prod,
      cod_prod,
      des_prod,
      t.fecha_trans,
      sub.docref_trans,
      sub.codigo_trans,
      sub.ope_trans,
      id_tipom,
      des_tipom,
      id_tipod,
      des_tipod,
      ingreso_unidades,
      moneda,
      precio,
      salidas_unidades,
      tipo,
      t.sucursal_trans';

      $qryFrom1 = '
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
              select * from entradas_documentos';

      $qryWhere1 = "";

      $qrySelect2 = '`id_prod`,
                    `cod_prod`,
                    `des_prod`,
                    \'0000-00-00\' `fecha_trans`,
                    `docref_trans`,
                    `codigo_trans`,
                    `ope_trans`,
                    `id_tipom`,
                    `des_tipom`,
                    `id_tipod`,
                    `des_tipod`,
                    `ingreso_unidades`,
                    `moneda`,
                    `precio`,
                    `salidas_unidades`,
                    \'\' AS `tipo`,
                    `sucursal_trans`';

      $qryFrom2 = 'stock_inicial';

      $qryWhere2 = '';

      if ( !empty($id_prod) ) {
        $qryWhere1 .= " AND id_prod = ". $id_prod;
        $qryWhere2 .= " AND id_prod = ". $id_prod;
      }

      if ( !empty($fecha_trans) ) {
         $qryWhere1 .= " AND t.fecha_trans BETWEEN '". $fechaDocInicio . "' AND '" . $fechaDocFin . "'";
      }

      $query =new Query();
      $query->select('*')
            ->from(['(
                (
                  SELECT ' . $qrySelect1 . '
                  FROM (' . $qryFrom1 . ') as sub
                  INNER JOIN transaccion t ON t.id_trans = sub.id_trans and t.sucursal_trans = sub.sucursal_trans
                  WHERE t.sucursal_trans = ' . $sucursal . ' ' . $qryWhere1 .'
                )
                UNION
                (
                  SELECT ' . $qrySelect2 . '
                  FROM ' . $qryFrom2 . '
                  WHERE `sucursal_trans` = ' . $sucursal . ' ' . $qryWhere2 . '
                )
            ) as t
            ORDER BY fecha_trans']);


      if (!empty($id_prod) || !empty($fecha_trans)) {

        //Subquery saldo anterior
        $queryEntAnteriores = $this->entradasAnteriores($id_prod, $fechaDocInicio, $sucursal);

        $querySalAnteriores = $this->salidasAnteriores($id_prod, $fechaDocInicio, $sucursal);

        $queryPrincipal = new Query();
        $queryPrincipal->select([
                                  'vp.id_prod',
                                  'vp.cod_prod',
                                  'vp.des_prod',
                                  'entradas_anteriores' => $queryEntAnteriores,
                                  'salidas_anteriores' => $querySalAnteriores,
                                  'p.stock_prod',
                                  'vp.stock_prod_bruto',
                                ])
                      ->from(['transaccion t'])
                      ->join('left join', 'trans_detalle td', 't.id_trans = td.trans_detalle')
                      ->join('left join', 'producto p', 'p.id_prod = td.prod_detalle')
                      ->join('left join', 'v_productos vp', 'vp.id_prod = td.prod_detalle')
                      ->where(['=','vp.id_prod',$id_prod])
                      ->andWhere(['=','t.ope_trans','S'])
                      ->andWhere(['=','t.status_trans',1])
                      ->andWhere(['=','t.sucursal_trans',1]);

        // if ( !empty($fechaDocInicio) && !empty($fechaDocFin) ) {
        //   $queryMinFecha->andWhere(['between','fecha_trans',$fechaDocInicio,$fechaDocFin]);
        // }

        $queryPrincipal->groupBy('vp.id_prod,vp.cod_prod,vp.des_prod,p.stock_prod,p.stockini_prod,vp.stock_prod_bruto');

        $qryPpal = $queryPrincipal->all();
      }

      $models = $query->all();
      $total = 0;
      $data = [];

      if ( !empty( $qryPpal ) ) {
        $total = $qryPpal[0]['entradas_anteriores'] - $qryPpal[0]['salidas_anteriores'];
        $data[] = [
          'id_prod' => '',
          'cod_prod' => trim($qryPpal[0]['cod_prod']),
          'des_prod' => trim($qryPpal[0]['des_prod']),
          'docref_trans' => trim($qryPpal[0]['cod_prod']).' - '.trim($qryPpal[0]['des_prod']),
          'codigo_trans' => Yii::t('rpts', 'Previous balance').' =======>>>',
          'ope_trans' => '',
          'id_tipom' => '',
          'des_tipom' => '',
          'id_tipod' => '',
          'des_tipod' => '',
          'ingreso_unidades' => $qryPpal[0]['entradas_anteriores'],
          'moneda' => '',
          'precio_compra_ext' => '',
          'precio_compra_soles' => '',
          'ingreso_valorizados' =>'',
          'salidas_unidades' => $qryPpal[0]['salidas_anteriores'],
          'tipo' => '',
          'sucursal_trans' => '',
          'saldo' => $total,
        ];
      }

      foreach ($models as $key => $value) {
        // code...
        $value['fecha_trans'] = $value['fecha_trans'] == '0000-00-00' ? '' : $value['fecha_trans'];
        $total = $total + floatval($value['ingreso_unidades']) - floatval($value['salidas_unidades']);
        $value['saldo'] = $total;
        $data[ $key + 1 ] = $value;
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

      $dataProvider->sort->attributes['fecha_trans'] = [
        'asc' => ['fecha_trans' => SORT_ASC],
        'desc' => ['fecha_trans' => SORT_DESC],
      ];

      $this->load($params);

      if (!$this->validate() || (empty($params['TransaccionSearch']['id_prod']) && empty($params['TransaccionSearch']['fecha_trans'])) ) {
        // uncomment the following line if you do not want to return any records when validation fails
        $query->where('0=1');
        $dataProvider->models = [];
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

    private function minFecha($id_prod = null, $fechaDocInicio = null , $fechaDocFin = null, $sucursal)
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

      return $queryMinFecha;
    }

    private function stockInicial($id_prod = null, $minFecha, $sucursal)
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

    private function stockFechaInicial($id_prod = null, $minFecha, $sucursal)
    {
      $queryFinicial = new Query();
      $queryFinicial->select([ 'coalesce(fecha_trans,0) as fecha_inicial'])
                    ->from(['transaccion'])
                    ->join('INNER JOIN', 'trans_detalle', 'id_trans = trans_detalle')
                    ->where(["=","sucursal_trans",$sucursal])
                    ->andWhere(['=','status_trans','1'])
                    ->andWhere(['=','ope_trans','S'])
                    ->andWhere(['<','fecha_trans', $minFecha]);

      if ( !empty($id_prod) ) {
        $queryFinicial->andWhere(['=','prod_detalle',$id_prod]);
      }

      return $queryFinicial;
    }

    private function entradasAnteriores($id_prod, $minFecha, $sucursal)
    {
      $querySanterior = new Query();
      $querySanterior->select([ 'coalesce(sum(cant_detalle),0) as saldo_anterior'])
                        ->from(['transaccion'])
                        ->join('INNER JOIN', 'trans_detalle', 'id_trans = trans_detalle')
                        ->where(["=","sucursal_trans",$sucursal])
                        ->andWhere(['=','status_trans','1'])
                        ->andWhere(['=','ope_trans','E'])
                        ->andWhere(['<','fecha_trans', $minFecha]);

      if ( !empty($id_prod) ) {
        $querySanterior->andWhere(['=','prod_detalle',$id_prod]);
      }

      return $querySanterior;
    }

    private function salidasAnteriores($id_prod, $minFecha, $sucursal)
    {
      $querySanterior = new Query();
      $querySanterior->select([ 'coalesce(sum(cant_detalle),0) as salidas_anteriores'])
                        ->from(['transaccion'])
                        ->join('INNER JOIN', 'trans_detalle', 'id_trans = trans_detalle')
                        ->where(["=","sucursal_trans",$sucursal])
                        ->andWhere(['=','status_trans','1'])
                        ->andWhere(['=','ope_trans','S'])
                        ->andWhere(['<','fecha_trans', $minFecha]);

      if ( !empty($id_prod) ) {
        $querySanterior->andWhere(['=','prod_detalle',$id_prod]);
      }

      return $querySanterior;
    }
}
