<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoListap;

/**
 * TipoListapSearch represents the model behind the search form of `app\models\TipoListap`.
 */
class TipoListapSearch extends TipoListap
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista', 'estatus_lista', 'sucursal_lista'], 'integer'],
            [['desc_lista'], 'safe'],
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
        $query = TipoListap::find()
                 ->where('sucursal_lista = :sucursal')
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
            'id_lista' => $this->id_lista,
            'estatus_lista' => $this->estatus_lista,
            'sucursal_lista' => $this->sucursal_lista,
        ]);

        $query->andFilterWhere(['like', 'desc_lista', $this->desc_lista]);

        return $dataProvider;
    }
}
