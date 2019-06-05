<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ListaPrecios;

/**
 * ListaPreciosSearch represents the model behind the search form of `app\models\ListaPrecios`.
 */
class ListaPreciosSearch extends ListaPrecios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista', 'tipo_lista', 'prod_lista', 'sucursal_lista'], 'integer'],
            [['precio_lista'], 'number'],
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
        $query = ListaPrecios::find();

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
            'tipo_lista' => $this->tipo_lista,
            'prod_lista' => $this->prod_lista,
            'precio_lista' => $this->precio_lista,
            'sucursal_lista' => $this->sucursal_lista,
        ]);

        return $dataProvider;
    }
}
