<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaccion;
use yii\data\SqlDataProvider;

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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_trans', 'tipo_trans', 'numdoc_trans', 'idrefdoc_trans', 'almacen_trans', 'sucursal_trans', 'usuario_trans', 'status_trans',
                'id_prod',], 'integer'],
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
      $sqlCount = "select count(*)
                    from
                    (
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
                    ) as t";
      $sqlSelect = "select
                      id_prod,
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
                      sucursal_trans
                    from
                    (
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
                    ) as t";

      $count = Yii::$app->db->createCommand($sqlCount, [])->queryScalar();

      $dataProvider = new SqlDataProvider([
          'sql' => $sqlSelect,
          'totalCount' => $count,
          'pagination' => [
              'pageSize' => 20,
          ],
      ]);


      $this->load($params);
      //
      if (!$this->validate()) {
          // uncomment the following line if you do not want to return any records when validation fails
          $query->where('0=1');
          return $dataProvider;
      }

      return $dataProvider;
    }
}
