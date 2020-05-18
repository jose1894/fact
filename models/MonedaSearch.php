<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Moneda;

/**
 * MonedaSearch represents the model behind the search form of `app\models\Moneda`.
 */
class MonedaSearch extends Moneda
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_moneda', 'status_moneda', 'sucursal_moneda'], 'integer'],
            [['des_moneda', 'tipo_moneda'], 'safe'],
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
        $query = Moneda::find()
                 ->where('sucursal_moneda= :sucursal')
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
            'id_moneda' => $this->id_moneda,
            'status_moneda' => $this->status_moneda,
            'sucursal_moneda' => $this->sucursal_moneda,
        ]);

        $query->andFilterWhere(['like', 'des_moneda', $this->des_moneda])
            ->andFilterWhere(['like', 'tipo_moneda', $this->tipo_moneda]);

        return $dataProvider;
    }
}
