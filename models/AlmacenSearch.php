<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Almacen;

/**
 * AlmacenSearch represents the model behind the search form of `app\models\Almacen`.
 */
class AlmacenSearch extends Almacen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_almacen', 'status_almacen', 'sucursal_almacen'], 'integer'],
            [['des_almacen'], 'safe'],
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

        $query = Almacen::find()
                 ->where('sucursal_almacen = :sucursal')
                 ->addParams([':sucursal' => $sucursal]);;

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
            'id_almacen' => $this->id_almacen,
            'status_almacen' => $this->status_almacen,
            'sucursal_almacen' => $this->sucursal_almacen,
        ]);

        $query->andFilterWhere(['like', 'des_almacen', $this->des_almacen]);

        return $dataProvider;
    }
}
