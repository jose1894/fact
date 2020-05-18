<?php

namespace app\models;

use Yii;
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
            [['id_depto', 'status_depto', 'sucursal_depto','prov_depto','pais_depto'], 'integer'],
            [['des_depto','prov_depto','pais_depto'], 'safe'],

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
$sucursal = Yii::$app->user->identity->profiles->sucursal;
        $query = Departamento::find()
                 ->where('sucursal_depto = :sucursal')
                 ->addParams([':sucursal' => $sucursal]);

        // add conditions that should always apply here

        $query->joinWith(['provDepto','paisDepto']);

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
            'id_depto' => $this->id_depto,
            'prov_depto' => $this->prov_depto,
            'pais_depto' => $this->pais_depto,
            'status_depto' => $this->status_depto,
            'sucursal_depto' => $this->sucursal_depto,
        ]);

        $query->andFilterWhere(['like', 'des_depto', $this->des_depto]);

        return $dataProvider;
    }
}
