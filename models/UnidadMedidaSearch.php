<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnidadMedida;

/**
 * UnidadMedidaSearch represents the model behind the search form of `app\models\UnidadMedida`.
 */
class UnidadMedidaSearch extends UnidadMedida
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_und', 'status_und', 'sucursal_und'], 'integer'],
            [['des_und'], 'safe'],
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
        $query = UnidadMedida::find()
                 ->where('sucursal_und = :sucursal')
                 ->addParams([':sucursal' => $sucursal]);

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
            'id_und' => $this->id_und,
            'status_und' => $this->status_und,
            'sucursal_und' => $this->sucursal_und,
        ]);

        $query->andFilterWhere(['like', 'des_und', $this->des_und]);

        return $dataProvider;
    }
}
