<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pais;

/**
 * PaisSearch represents the model behind the search form of `app\models\Pais`.
 */
class PaisSearch extends Pais
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pais', 'status_pais', 'sucursal_pais'], 'integer'],
            [['cod_pais', 'des_pais'], 'safe'],
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
        $query = Pais::find()
                 ->where('sucursal_pais = :sucursal')
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
            'id_pais' => $this->id_pais,
            'status_pais' => $this->status_pais,
            'sucursal_pais' => $this->sucursal_pais,
        ]);

        $query->andFilterWhere(['like', 'cod_pais', $this->cod_pais])
            ->andFilterWhere(['like', 'des_pais', $this->des_pais]);

        return $dataProvider;
    }
}
