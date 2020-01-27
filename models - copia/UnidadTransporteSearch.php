<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnidadTransporte;

/**
 * UnidadTransporteSearch represents the model behind the search form of `app\models\UnidadTransporte`.
 */
class UnidadTransporteSearch extends UnidadTransporte
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_utransp', 'status_utransp', 'sucursal_utransp'], 'integer'],
            [['des_utransp'], 'safe'],
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
        $query = UnidadTransporte::find()
                 ->where('sucursal_utransp = :sucursal')
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
            'id_utransp' => $this->id_utransp,
            'status_utransp' => $this->status_utransp,
            'sucursal_utransp' => $this->sucursal_utransp,
        ]);

        $query->andFilterWhere(['like', 'des_utransp', $this->des_utransp]);

        return $dataProvider;
    }
}
