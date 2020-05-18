<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form of `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_clte','tipoid_clte', 'pais_cte', 'depto_cte', 'provi_cte', 'dtto_clte', 'vendedor_clte', 'estatus_ctle', 'condp_clte', 'sucursal_clte'], 'integer'],
            [['dni_clte', 'ruc_clte', 'nombre_clte', 'direcc_clte', 'tlf_ctle', 'tipoid_clte'], 'safe'],
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

        $query = Cliente::find()
                ->where('sucursal_clte = :sucursal')
                ->addParams([':sucursal' => $sucursal]);
        $query->joinWith(['provClte','paisClte','deptoClte','dttoClte','condpClte','vendedorClte']);
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
            'id_clte' => $this->id_clte,
            'pais_cte' => $this->pais_cte,
            'depto_cte' => $this->depto_cte,
            'provi_cte' => $this->provi_cte,
            'dtto_clte' => $this->dtto_clte,
            'vendedor_clte' => $this->vendedor_clte,
            'estatus_ctle' => $this->estatus_ctle,
            'condp_clte' => $this->condp_clte,
            'sucursal_clte' => $this->sucursal_clte,
            'tipoid_clte' => $this->tipoid_clte,
        ]);

        $query->andFilterWhere(['like', 'dni_clte', $this->dni_clte])
            ->andFilterWhere(['like', 'ruc_clte', $this->ruc_clte])
            ->andFilterWhere(['like', 'nombre_clte', $this->nombre_clte])
            ->andFilterWhere(['like', 'direcc_clte', $this->direcc_clte])
            ->andFilterWhere(['like', 'tlf_ctle', $this->tlf_ctle]);

        return $dataProvider;
    }
}
