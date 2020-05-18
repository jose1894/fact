<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MotivoTraslado;

/**
 * MotivoTrasladoSearch represents the model behind the search form of `app\models\MotivoTraslado`.
 */
class MotivoTrasladoSearch extends MotivoTraslado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_motivo', 'status_motivo', 'sucursal_motivo'], 'integer'],
            [['des_motivo'], 'safe'],
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
        $query = MotivoTraslado::find()
                 ->where('sucursal_motivo = :sucursal')
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
            'id_motivo' => $this->id_motivo,
            'status_motivo' => $this->status_motivo,
            'sucursal_motivo' => $this->sucursal_motivo,
        ]);

        $query->andFilterWhere(['like', 'des_motivo', $this->des_motivo]);

        return $dataProvider;
    }
}
