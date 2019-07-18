<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Distrito;

/**
 * DistritoSearch represents the model behind the search form of `app\models\Distrito`.
 */
class DistritoSearch extends Distrito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dtto', 'status_dtto', 'sucursal_dtto','pais_dtto','prov_dtto','depto_dtto'], 'integer'],
            [['des_dtto','prov_dtto','pais_dtto'], 'safe'],
            //[['prov_dtto','pais_dtto','depto_dtto'], 'string'],
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
        $query = Distrito::find()
                 ->where('sucursal_dtto= :sucursal')
                 ->addParams([':sucursal' => $sucursal]);
        $query->joinWith(['provDtto','paisDtto','deptoDtto']);

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
            'id_dtto' => $this->id_dtto,
            'pais_dtto' => $this->pais_dtto,
            'prov_dtto' => $this->prov_dtto,
            'depto_dtto' => $this->depto_dtto,
            'status_dtto' => $this->status_dtto,
            'sucursal_dtto' => $this->sucursal_dtto,
        ]);

        $query->andFilterWhere(['like', 'des_dtto', $this->des_dtto]);
        return $dataProvider;
    }
}
