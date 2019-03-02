<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empresa;

/**
 * EmpresaSearch represents the model behind the search form of `app\models\Empresa`.
 */
class EmpresaSearch extends Empresa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empresa', 'estatus_empresa', 'tipopers_empresa'], 'integer'],
            [['nombre_empresa', 'dni_empresa', 'ruc_empresa', 'tlf_empresa', 'direcc_empresa'], 'safe'],
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
        $query = Empresa::find();

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
            'id_empresa' => $this->id_empresa,
            'estatus_empresa' => $this->estatus_empresa,
            'tipopers_empresa' => $this->tipopers_empresa,
        ]);

        $query->andFilterWhere(['like', 'nombre_empresa', $this->nombre_empresa])
            ->andFilterWhere(['like', 'dni_empresa', $this->dni_empresa])
            ->andFilterWhere(['like', 'ruc_empresa', $this->ruc_empresa])
            ->andFilterWhere(['like', 'tlf_empresa', $this->tlf_empresa])
            ->andFilterWhere(['like', 'direcc_empresa', $this->direcc_empresa]);

        return $dataProvider;
    }
}
