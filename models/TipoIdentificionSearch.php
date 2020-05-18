<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoIdentificacion;

/**
 * TipoIdentificionSearch represents the model behind the search form of `app\models\TipoIdentificacion`.
 */
class TipoIdentificionSearch extends TipoIdentificacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipoi', 'status_tipoi', 'sucursal_tipoi'], 'integer'],
            [['cod_tipoi', 'des_tipoi'], 'safe'],
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
        $query = TipoIdentificacion::find();

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
            'id_tipoi' => $this->id_tipoi,
            'status_tipoi' => $this->status_tipoi,
            'sucursal_tipoi' => $this->sucursal_tipoi,
        ]);

        $query->andFilterWhere(['like', 'cod_tipoi', $this->cod_tipoi])
            ->andFilterWhere(['like', 'des_tipoi', $this->des_tipoi]);

        return $dataProvider;
    }
}
