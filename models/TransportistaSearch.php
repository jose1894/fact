<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transportista;

/**
 * TransportistaSearch represents the model behind the search form of `app\models\Transportista`.
 */
class TransportistaSearch extends Transportista
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_transp', 'status_transp', 'sucursal_transp'], 'integer'],
            [['des_transp'], 'safe'],
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
        $query = Transportista::find();

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
            'id_transp' => $this->id_transp,
            'status_transp' => $this->status_transp,
            'sucursal_transp' => $this->sucursal_transp,
        ]);

        $query->andFilterWhere(['like', 'des_transp', $this->des_transp]);

        return $dataProvider;
    }
}
