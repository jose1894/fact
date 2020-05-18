<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proveedor;

/**
 * ProveedorSearch represents the model behind the search form of `app\models\Proveedor`.
 */
class ProveedorSearch extends Proveedor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prove', 'pais_prove', 'depto_prove', 'provi_prove', 'dtto_prove', 'tipo_prove', 'status_prove', 'sucursal_prove'], 'integer'],
            [['dni_prove', 'ruc_prove', 'nombre_prove', 'direcc_prove', 'tlf_prove'], 'safe'],
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
        $query = Proveedor::find()
                 ->where('sucursal_prov = :sucursal')
                 ->addParams([':sucursal' => $sucursal]);
        $query->joinWith(['proviProve','paisProve','deptoProve','dttoProve',]);

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
            'id_prove' => $this->id_prove,
            'pais_prove' => $this->pais_prove,
            'depto_prove' => $this->depto_prove,
            'provi_prove' => $this->provi_prove,
            'dtto_prove' => $this->dtto_prove,
            'tipo_prove' => $this->tipo_prove,
            'status_prove' => $this->status_prove,
            'sucursal_prove' => $this->sucursal_prove,
        ]);

        $query->andFilterWhere(['like', 'dni_prove', $this->dni_prove])
            ->andFilterWhere(['like', 'ruc_prove', $this->ruc_prove])
            ->andFilterWhere(['like', 'nombre_prove', $this->nombre_prove])
            ->andFilterWhere(['like', 'direcc_prove', $this->direcc_prove])
            ->andFilterWhere(['like', 'tlf_prove', $this->tlf_prove]);

        return $dataProvider;
    }
}
