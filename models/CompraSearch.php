<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Compra;

/**
 * CompraSearch represents the model behind the search form of `app\models\Compra`.
 */
class CompraSearch extends Compra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_compra', 'provee_compra', 'moneda_compra', 'condp_compra', 'usuario_compra', 'estatus_compra', 'sucursal_compra'], 'integer'],
            [['cod_compra', 'fecha_compra', 'edicion_compra', 'nrodoc_compra'], 'safe'],
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
        $query = Compra::find();

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
            'id_compra' => $this->id_compra,
            'fecha_compra' => $this->fecha_compra,
            'provee_compra' => $this->provee_compra,
            'moneda_compra' => $this->moneda_compra,
            'condp_compra' => $this->condp_compra,
            'usuario_compra' => $this->usuario_compra,
            'estatus_compra' => $this->estatus_compra,
            'sucursal_compra' => $this->sucursal_compra,
        ]);

        $query->andFilterWhere(['like', 'cod_compra', $this->cod_compra])
            ->andFilterWhere(['like', 'edicion_compra', $this->edicion_compra])
            ->andFilterWhere(['like', 'nrodoc_compra', $this->nrodoc_compra]);

        return $dataProvider;
    }
}
