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

    public function rules()
    {
        return [
            [['id_prov', 'status_prov', 'sucursal_prov','pais_prov'], 'integer'],
            [['des_prov','pais_prov'], 'safe'],
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

        $query->joinWith(['paisProv']);

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
            'id_prov' => $this->id_prov,
            'status_prov' => $this->status_prov,
            'sucursal_prov' => $this->sucursal_prov,
            'pais_prov' => $this->pais_prov,
        ]);

        $query->andFilterWhere(['like', 'des_prov', $this->des_prov]);

        return $dataProvider;
    }
}
