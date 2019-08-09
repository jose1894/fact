<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoMovimiento;

/**
 * TipoMovimientoSearch represents the model behind the search form of `app\models\TipoMovimiento`.
 */
class TipoMovimientoSearch extends TipoMovimiento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipom', 'status_tipom', 'sucursal_tipom'], 'integer'],
            [['des_tipom'], 'safe'],
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
        $user = User::findOne(Yii::$app->user->id);
        $sucursal = $user->sucursal0->id_suc;
        $query = TipoMovimiento::find()
                 ->where('sucursal_tipom = :sucursal')
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
            'id_tipom' => $this->id_tipom,
            'status_tipom' => $this->status_tipom,
            'sucursal_tipom' => $this->sucursal_tipom,
        ]);

        $query->andFilterWhere(['like', 'des_tipom', $this->des_tipom]);

        return $dataProvider;
    }
}
