<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Departamento;

/**
 * DepartamentoSearch represents the model behind the search form of `app\models\Departamento`.
 */
class DepartamentoSearch extends Departamento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_depto', 'status_depto', 'sucursal_depto'], 'integer'],
            [['des_depto','prov_depto','pais_depto'], 'safe'],
            [['prov_depto','pais_depto'], 'string'],
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
        $query = Departamento::find();

        // add conditions that should always apply here

        $query->joinWith(['provDepto','paisDepto']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['provDepto.des_prov'] = [
           'asc' => ['provincia.des_prov' => SORT_ASC],
           'desc' => ['provincia.des_prov' => SORT_DESC],
       ];

      $dataProvider->sort->attributes['paisDepto.des_pais'] = [
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
            'id_depto' => $this->id_depto,
            //'prov_depto' => $this->prov_depto,
            'status_depto' => $this->status_depto,
            'sucursal_depto' => $this->sucursal_depto,
        ]);

        $query->andFilterWhere(['like', 'des_depto', $this->des_depto])
              ->andFilterWhere(['like', 'provincia.des_prov', $this->prov_depto])
              ->andFilterWhere(['like', 'pais.des_pais', $this->pais_depto]);

        return $dataProvider;
    }
}
