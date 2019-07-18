<?php

namespace app\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;

/**
 * ProductoSearch represents the model behind the search form of `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prod', 'tipo_prod', 'umed_prod', 'contenido_prod', 'exctoigv_prod', 'compra_prod', 'venta_prod', 'stockini_prod', 'stockmax_prod', 'stockmin_prod', 'status_prod', 'sucursal_prod'], 'integer'],
            [['cod_prod', 'des_prod'], 'safe'],
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
        $query = Producto::find()
                 ->where('sucursal_prod = :sucursal')
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
            'id_prod' => $this->id_prod,
            'tipo_prod' => $this->tipo_prod,
            'umed_prod' => $this->umed_prod,
            'contenido_prod' => $this->contenido_prod,
            'exctoigv_prod' => $this->exctoigv_prod,
            'compra_prod' => $this->compra_prod,
            'venta_prod' => $this->venta_prod,
            'stockini_prod' => $this->stockini_prod,
            'stockmax_prod' => $this->stockmax_prod,
            'stockmin_prod' => $this->stockmin_prod,
            'status_prod' => $this->status_prod,
            'sucursal_prod' => $this->sucursal_prod,
        ]);

        $query->andFilterWhere(['like', 'cod_prod', $this->cod_prod])
            ->andFilterWhere(['like', 'des_prod', $this->des_prod]);

        return $dataProvider;
    }
}
