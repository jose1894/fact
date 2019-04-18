<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vendedor;

/**
 * VendedorSearch represents the model behind the search form of `app\models\Vendedor`.
 */
class VendedorSearch extends Vendedor
{
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['id_vendedor', 'estatus_vend', 'sucursal_vend'], 'integer'],
            [['dni_vend', 'nombre_vend', 'tlf_vend','zona_vend'], 'safe'],
            [['zona_vend'],'string'],
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
        $query = Vendedor::find();

        $query->joinWith(['zonaVend']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['zonaVend.nombre_zona'] = [
           'asc' => ['zona.nombre_zona' => SORT_ASC],
           'desc' => ['zona.nombre_zona' => SORT_DESC],
       ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_vendedor' => $this->id_vendedor,
            'estatus_vend' => $this->estatus_vend,
            'sucursal_vend' => $this->sucursal_vend,
           //'zona_vend' => $this->zona_vend,
        ]);

        $query->andFilterWhere(['like', 'dni_vend', $this->dni_vend])
            ->andFilterWhere(['like', 'nombre_vend', $this->nombre_vend])
            ->andFilterWhere(['like', 'tlf_vend', $this->tlf_vend])
            ->andFilterWhere(['like', 'zona.nombre_zona', $this->zona_vend]);

        return $dataProvider;
    }
}
