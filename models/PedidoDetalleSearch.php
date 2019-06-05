<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PedidoDetalle;

/**
 * PedidoDetalleSearch represents the model behind the search form of `app\models\PedidoDetalle`.
 */
class PedidoDetalleSearch extends PedidoDetalle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pdetalle', 'prod_pdetalle', 'status_pdetalle', 'pedido_pdetalle'], 'integer'],
            [['cant_pdetalle', 'precio_pdetalle', 'descu_pdetalle', 'impuesto_pdetalle'], 'number'],
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
        $query = PedidoDetalle::find();

        // add conditions that should always apply here

        $query = PedidoDetalle::find()->indexBy('id_pdetalle'); 

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pdetalle' => $this->id_pdetalle,
            'prod_pdetalle' => $this->prod_pdetalle,
            'cant_pdetalle' => $this->cant_pdetalle,
            'precio_pdetalle' => $this->precio_pdetalle,
            'descu_pdetalle' => $this->descu_pdetalle,
            'impuesto_pdetalle' => $this->impuesto_pdetalle,
            'status_pdetalle' => $this->status_pdetalle,
            'pedido_pdetalle' => $this->pedido_pdetalle,
        ]);

        return $dataProvider;
    }
}
