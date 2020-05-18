<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoDocumento;

/**
 * TipoDocumentoSearch represents the model behind the search form of `app\models\TipoDocumento`.
 */
class TipoDocumentoSearch extends TipoDocumento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipod', 'sucursal_tipod', 'status_tipod'], 'integer'],
            [['des_tipod','abrv_tipod','ope_tipod'], 'safe'],
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
        $query = TipoDocumento::find()
                 ->where('sucursal_tipod = :sucursal')
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
            'id_tipod' => $this->id_tipod,
            'sucursal_tipod' => $this->sucursal_tipod,
            'status_tipod' => $this->status_tipod,
            'abrv_tipod' => $this->abrv_tipod,
            'ope_tipod' => $this->ope_tipod,
        ]);

        $query->andFilterWhere(['like', 'des_tipod', $this->des_tipod]);

        return $dataProvider;
    }
}
