<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Zona;

/**
 * ZonaSearch represents the model behind the search form of `app\models\Zona`.
 */
class ZonaSearch extends Zona
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_zona', 'estatus_zona', 'sucursal_zona'], 'integer'],
            [['nombre_zona', 'desc_zona'], 'safe'],
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
        $query = Zona::find()
                 ->where('sucursal_zona = :sucursal')
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
            'id_zona' => $this->id_zona,
            'estatus_zona' => $this->estatus_zona,
            'sucursal_zona' => $this->sucursal_zona,
        ]);

        $query->andFilterWhere(['like', 'nombre_zona', $this->nombre_zona])
            ->andFilterWhere(['like', 'desc_zona', $this->desc_zona]);

        return $dataProvider;
    }
}
