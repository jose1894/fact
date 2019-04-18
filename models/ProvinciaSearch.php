<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Provincia;

/**
 * ProvinciaSearch represents the model behind the search form of `app\models\Provincia`.
 */
class ProvinciaSearch extends Provincia
{
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['id_prov', 'status_prov', 'sucursal_prov'], 'integer'],
            [['des_prov','pais_prov'], 'safe'],
            [['pais_prov'], 'string'],
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
        $query = Provincia::find();

        // add conditions that should always apply here

        $query->joinWith(['paisProv']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['paisProv.des_pais'] = [
           'asc' => ['pais.des_pais' => SORT_ASC],
           'desc' => ['pais.des_pais' => SORT_DESC],
       ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_prov' => $this->id_prov,
            'status_prov' => $this->status_prov,
            'sucursal_prov' => $this->sucursal_prov,
            //'pais_prov' => $this->pais_prov,
        ]);

        $query->andFilterWhere(['like', 'des_prov', $this->des_prov])
              ->andFilterWhere(['like', 'pais.des_pais', $this->pais_prov]);

        return $dataProvider;
    }
}
