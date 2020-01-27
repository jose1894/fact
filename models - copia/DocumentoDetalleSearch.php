<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocumentoDetalle;

/**
 * DocumentoDetalleSearch represents the model behind the search form of `app\models\DocumentoDetalle`.
 */
class DocumentoDetalleSearch extends DocumentoDetalle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ddetalle', 'prod_ddetalle', 'status_ddetalle', 'documento_ddetalle'], 'integer'],
            [['cant_ddetalle', 'precio_ddetalle', 'descu_ddetalle', 'impuesto_ddetalle', 'plista_ddetalle', 'total_ddetalle'], 'number'],
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
        $query = DocumentoDetalle::find();

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
            'id_ddetalle' => $this->id_ddetalle,
            'prod_ddetalle' => $this->prod_ddetalle,
            'cant_ddetalle' => $this->cant_ddetalle,
            'precio_ddetalle' => $this->precio_ddetalle,
            'descu_ddetalle' => $this->descu_ddetalle,
            'impuesto_ddetalle' => $this->impuesto_ddetalle,
            'status_ddetalle' => $this->status_ddetalle,
            'documento_ddetalle' => $this->documento_ddetalle,
            'plista_ddetalle' => $this->plista_ddetalle,
            'total_ddetalle' => $this->total_ddetalle,
        ]);

        return $dataProvider;
    }
}
