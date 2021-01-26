<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Marca;

/**
 * MarcaSearch represents the model behind the search form of `app\models\Marca`.
 */
class MarcaSearch extends Marca
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_marca', 'status_marca', 'sucursal_marca'], 'integer'],
            [['desc_marca'], 'safe'],
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
        $query = Marca::find();

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
            'id_marca' => $this->id_marca,
            'status_marca' => $this->status_marca,
            'sucursal_marca' => $this->sucursal_marca,
        ]);

        $query->andFilterWhere(['like', 'desc_marca', $this->desc_marca]);

        return $dataProvider;
    }
}
