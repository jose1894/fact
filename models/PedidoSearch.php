<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;

/**
 * PedidoSearch represents the model behind the search form of `app\models\Pedido`.
 */
class PedidoSearch extends Pedido
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pedido', 'clte_pedido', 'vend_pedido', 'moneda_pedido', 'almacen_pedido', 'usuario_pedido','condp_pedido', 'estatus_pedido', 'sucursal_pedido'], 'integer'],
            [['tipo_pedido'],'string'],
            [['cod_pedido', 'fecha_pedido', 'tipo_pedido','estatus_pedido', 'string'], 'safe'],
            [['total_pedido','vend_pedido',  'clte_pedido', 'integer'], 'safe'],
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
    public function search($params)
    {
        $user = User::findOne(Yii::$app->user->id);
        $sucursal = $user->sucursal0->id_suc;
        $query = Pedido::find()
                 ->where('sucursal_pedido = :sucursal')
                 ->addParams([':sucursal' => $sucursal]);
        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'fecha_pedido' => SORT_DESC,
                    'cod_pedido' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id_pedido' => $this->id_pedido,
            'fecha_pedido' => $this->fecha_pedido,
            'clte_pedido' => $this->clte_pedido,
            'vend_pedido' => $this->vend_pedido,
            'moneda_pedido' => $this->moneda_pedido,
            'almacen_pedido' => $this->almacen_pedido,
            'tipo_pedido' => $this->tipo_pedido,
            'usuario_pedido' => $this->usuario_pedido,
            //'estatus_pedido' => $this->estatus_pedido,
            'sucursal_pedido' => $this->sucursal_pedido,
            'condp_pedido' => $this->condp_pedido,
        ]);

        $query->andFilterWhere(['like', 'cod_pedido', $this->cod_pedido])
               ->andFilterWhere(['in', 'estatus_pedido', $this->estatus_pedido]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchPendientes($params)
    {
        $user = User::findOne(Yii::$app->user->id);
        $sucursal = $user->sucursal0->id_suc;
        $query = Pedido::find()
                 ->where('sucursal_pedido = :sucursal',[':sucursal' => $sucursal])
                 ->andWhere(['estatus_pedido' => [Pedido::STATUS_INACTIVO,Pedido::GUIA_GENERADA]])
                 ->andWhere('tipo_pedido = :tipo',[':tipo' => Pedido::PEDIDO]);
        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'fecha_pedido' => SORT_DESC,
            //         'cod_pedido' => SORT_DESC,
            //     ]
            // ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id_pedido' => $this->id_pedido,
            'fecha_pedido' => $this->fecha_pedido,
            'clte_pedido' => $this->clte_pedido,
            'vend_pedido' => $this->vend_pedido,
            'moneda_pedido' => $this->moneda_pedido,
            'almacen_pedido' => $this->almacen_pedido,
            'tipo_pedido' => $this->tipo_pedido,
            'usuario_pedido' => $this->usuario_pedido,
            //'estatus_pedido' => $this->estatus_pedido,
            'sucursal_pedido' => $this->sucursal_pedido,
            'condp_pedido' => $this->condp_pedido,
        ]);

        $query->andFilterWhere(['like', 'cod_pedido', $this->cod_pedido])
               ->andFilterWhere(['in', 'estatus_pedido', $this->estatus_pedido]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchProformaPendientes($params)
    {
        $user = User::findOne(Yii::$app->user->id);
        $sucursal = $user->sucursal0->id_suc;
        $query = Pedido::find()
            ->where('sucursal_pedido = :sucursal',[':sucursal' => $sucursal])
            ->andWhere(['estatus_pedido' => [Pedido::STATUS_INACTIVO]])
            ->andWhere('tipo_pedido = :tipo',[':tipo' => Pedido::PROFORMA]);
        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'fecha_pedido' => SORT_DESC,
            //         'cod_pedido' => SORT_DESC,
            //     ]
            // ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id_pedido' => $this->id_pedido,
            'fecha_pedido' => $this->fecha_pedido,
            'clte_pedido' => $this->clte_pedido,
            'vend_pedido' => $this->vend_pedido,
            'moneda_pedido' => $this->moneda_pedido,
            'almacen_pedido' => $this->almacen_pedido,
            'tipo_pedido' => $this->tipo_pedido,
            'usuario_pedido' => $this->usuario_pedido,
            //'estatus_pedido' => $this->estatus_pedido,
            'sucursal_pedido' => $this->sucursal_pedido,
            'condp_pedido' => $this->condp_pedido,
        ]);

        $query->andFilterWhere(['like', 'cod_pedido', $this->cod_pedido])
            ->andFilterWhere(['in', 'estatus_pedido', $this->estatus_pedido]);

        return $dataProvider;
    }
}
