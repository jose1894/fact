<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CondPago;

/**
 * CondPagoSearch represents the model behind the search form of `app\models\CondPago`.
 */
class CondPagoSearch extends CondPago
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_condp', 'status_condp', 'sucursal_condp'], 'integer'],
            [['desc_condp'], 'safe'],
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
        $query = CondPago::find();

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
            'id_condp' => $this->id_condp,
            'status_condp' => $this->status_condp,
            'sucursal_condp' => $this->sucursal_condp,
        ]);

        $query->andFilterWhere(['like', 'desc_condp', $this->desc_condp]);

        return $dataProvider;
    }
}
