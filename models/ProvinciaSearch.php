<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Provincia;

/**
 * ProvinciaSearch represents the model behind the search form of `app\models\Provincia`.
 */
class ProvinciaSearch extends Provincia
{
    /**
     * {@inheritdoc}
     */
     public $pais;

    public function rules()
    {
        return [
            [['id_prov', 'status_prov', 'sucursal_prov','depto_prov'], 'integer'],
            [['pais','des_prov','depto_prov'], 'safe'],
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
        $query = Provincia::find()

                 ->where('sucursal_prov = :sucursal')
                 ->addParams([':sucursal' => $sucursal]);

        // add conditions that should always apply here

        $query->join('left join','departamento','depto_prov = id_depto');
        $query->join('inner join','pais', 'pais.id_pais = departamento.pais_depto');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['pais'] = [
            'asc' => ['pais.des_pais' => SORT_ASC],
            'desc' => ['pais.des_pais' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id_prov' => $this->id_prov,
            'status_prov' => $this->status_prov,
            'sucursal_prov' => $this->sucursal_prov,
            'depto_prov' => $this->depto_prov,
            'pais.id_pais' => $this->pais,
        ]);

        $query->andFilterWhere(['like', 'des_prov', $this->des_prov]);

        return $dataProvider;
    }
}
