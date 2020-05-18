<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NotaCredito;

/**
 * DocumentoSearch represents the model behind the search form of `app\models\Documento`.
 */
class NotaCreditoSearch extends NotaCredito
{
    public $cliente;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_doc', 'tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc','cliente'], 'integer'],
            [['cod_doc', 'fecha_doc', 'obsv_doc','status_doc','cliente'], 'safe'],
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
$sucursal = Yii::$app->user->identity->profiles->sucursal;
        $query = NotaCredito::find()
            ->where([
                'sucursal_doc' => $sucursal,
                'tipo_doc' => [NotaCredito::TIPO_NCREDITO],
                'status_doc' =>[NotaCredito::DOCUMENTO_GENERADO, documento::DOCUMENTO_ANULADO]
            ]);

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
            'sucursal_doc' => $this->sucursal_doc,
        ]);

        $query->andFilterWhere(['like', 'cod_doc', $this->cod_doc])
            ->andFilterWhere(['like', 'obsv_doc', $this->obsv_doc])
            ->andFilterWhere(['in', 'status_doc', $this->status_doc]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchNotaCredito($params)
    {
$sucursal = Yii::$app->user->identity->profiles->sucursal;
        $query = NotaCredito::find()->joinWith(['pedidoDoc'])->joinWith('pedidoDoc.cltePedido')
                 ->where([
                            'sucursal_doc' => $sucursal,
                            'tipo_doc' => [Documento::TIPODOC_FACTURA, Documento::TIPODOC_BOLETA],
                            'status_doc' =>[Documento::DOCUMENTO_GENERADO, documento::DOCUMENTO_ANULADO]
                 ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['cliente'] = [
            'asc' => ['cliente.nombre_clte' => SORT_ASC],
            'desc' => ['cliente.nombre_clte' => SORT_DESC],
        ];

        $this->load($params);

        if ( !empty($this->fecha_doc) ) {
            $fecha = explode("/", $this->fecha_doc);
            $fecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
            $this->fecha_doc = $fecha;
        }

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
            'sucursal_doc' => $this->sucursal_doc,
        ]);

        $query->andFilterWhere(['like', 'cod_doc', $this->cod_doc])
            ->andFilterWhere(['like', 'obsv_doc', $this->obsv_doc])
            ->andFilterWhere(['like', 'cliente.id_clte', $this->cliente])
            ->andFilterWhere(['in', 'status_doc', $this->status_doc]);

        return $dataProvider;
    }
}
