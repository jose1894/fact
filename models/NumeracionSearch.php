<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Numeracion;

/**
 * NumeracionSearch represents the model behind the search form of `app\models\Numeracion`.
 */
class NumeracionSearch extends Numeracion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num', 'tipo_num', 'sucursal_num', 'status_num'], 'integer'],
            [['numero_num', 'serie_num'], 'safe'],
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
        $query = Numeracion::find()
                 ->where('sucursal_num = :sucursal')
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
            'id_num' => $this->id_num,
            'tipo_num' => $this->tipo_num,
            'sucursal_num' => $this->sucursal_num,
            'status_num' => $this->status_num,
        ]);

        $query->andFilterWhere(['like', 'numero_num', $this->numero_num])
            ->andFilterWhere(['like', 'serie_num', $this->serie_num]);

        return $dataProvider;
    }
}
