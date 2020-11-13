<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NotaIngreso;

/**
 * NotaIngresoSearch represents the model behind the search form of `app\models\NotaIngreso`.
 */
class NotaIngresoSearch extends NotaIngreso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_trans', 'tipo_trans', 'almacen_trans','status_trans'], 'integer'],
            [['codigo_trans', 'fecha_trans', 'obsv_trans', 'docref_trans','ope_trans','status_trans'], 'safe'],
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
        $query = NotaIngreso::find()
                 ->where('sucursal_trans = :sucursal')
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

        if ( !empty($this->fecha_trans) ) {
          $fechaTrans = explode(" - ", $this->fecha_trans);
          $fechaInicio = \DateTime::createFromFormat('d/m/Y', trim($fechaTrans[0]))->format('Y-m-d');
          $fechaFin = \DateTime::createFromFormat('d/m/Y', trim($fechaTrans[1]))->format('Y-m-d');
          $query->andFilterWhere(['between', 'fecha_trans', $fechaInicio, $fechaFin]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_trans' => $this->id_trans,
            // 'fecha_trans' => $this->fecha_trans,
            'tipo_trans' => $this->tipo_trans,
            'ope_trans' => $this->ope_trans,
            'status_trans' => $this->status_trans,
            'almacen_trans' => $this->almacen_trans,
            'sucursal_trans' => $this->sucursal_trans,
        ]);

        $query->andFilterWhere(['like', 'codigo_trans', $this->codigo_trans])
            ->andFilterWhere(['like', 'obsv_trans', $this->obsv_trans])
            ->andFilterWhere(['like', 'docref_trans', $this->docref_trans]);

        return $dataProvider;
    }
}
