<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Documento;

/**
 * DocumentoSearch represents the model behind the search form of `app\models\Documento`.
 */
class DocumentoSearch extends Documento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_doc', 'tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc'], 'integer'],
            [['cod_doc', 'fecha_doc', 'obsv_doc'], 'safe'],
            [['totalimp_doc', 'totaldsc_doc', 'total_doc'], 'number'],
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
        $query = Documento::find();

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
            'id_doc' => $this->id_doc,
            'tipo_doc' => $this->tipo_doc,
            'pedido_doc' => $this->pedido_doc,
            'fecha_doc' => $this->fecha_doc,
            'totalimp_doc' => $this->totalimp_doc,
            'totaldsc_doc' => $this->totaldsc_doc,
            'total_doc' => $this->total_doc,
            'status_doc' => $this->status_doc,
            'sucursal_doc' => $this->sucursal_doc,
        ]);

        $query->andFilterWhere(['like', 'cod_doc', $this->cod_doc])
            ->andFilterWhere(['like', 'obsv_doc', $this->obsv_doc]);

        return $dataProvider;
    }
}