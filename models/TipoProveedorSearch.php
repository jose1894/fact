<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoProveedor;

/**
 * TipoProveedorSearch represents the model behind the search form of `app\models\TipoProveedor`.
 */
class TipoProveedorSearch extends TipoProveedor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tprov', 'status_tprov', 'sucursal_tprov'], 'integer'],
            [['des_tprov'], 'safe'],
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
        $query = TipoProveedor::find()
                 ->where('sucursal_tprov = :sucursal')
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
            'id_tprov' => $this->id_tprov,
            'status_tprov' => $this->status_tprov,
            'sucursal_tprov' => $this->sucursal_tprov,
        ]);

        $query->andFilterWhere(['like', 'des_tprov', $this->des_tprov]);

        return $dataProvider;
    }
}
