<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CompraDetalle;

/**
 * CompraDetalleSearch represents the model behind the search form of `app\models\CompraDetalle`.
 */
class CompraDetalleSearch extends CompraDetalle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cdetalle', 'prod_cdetalle', 'status_cdetalle', 'compra_cdetalle'], 'integer'],
            [['cant_cdetalle', 'precio_cdetalle', 'descu_cdetalle', 'impuesto_cdetalle', 'plista_cdetalle', 'total_cdetalle'], 'number'],
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
        $query = CompraDetalle::find();

        // add conditions that should always apply here

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
            'id_cdetalle' => $this->id_cdetalle,
            'prod_cdetalle' => $this->prod_cdetalle,
            'cant_cdetalle' => $this->cant_cdetalle,
            'precio_cdetalle' => $this->precio_cdetalle,
            'descu_cdetalle' => $this->descu_cdetalle,
            'impuesto_cdetalle' => $this->impuesto_cdetalle,
            'status_cdetalle' => $this->status_cdetalle,
            'compra_cdetalle' => $this->compra_cdetalle,
            'plista_cdetalle' => $this->plista_cdetalle,
            'total_cdetalle' => $this->total_cdetalle,
        ]);

        return $dataProvider;
    }
}
