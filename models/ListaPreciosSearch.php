<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ListaPrecios;

/**
 * ListaPreciosSearch represents the model behind the search form of `app\models\ListaPrecios`.
 */
class ListaPreciosSearch extends ListaPrecios
{
    public $codigo;
    public $tipo_prod;
    public $marca;
    public $descripcion;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista', 'tipo_lista', 'prod_lista', 'sucursal_lista', 'descripcion', 'tipo_prod', 'marca'], 'integer'],
            [['codigo'], 'string'],
            [['precio_lista'], 'number'],
            [['codigo'], 'safe'],
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
      // ->join('LEFT join','producto','prod_lista = id_prod and sucursal_prod = sucursal_lista')
      // ->join('LEFT join','tipo_producto','id_tpdcto = tipo_prod and sucursal_prod = sucursal_tpdcto')
        $sucursal = Yii::$app->user->identity->profiles->sucursal;
        $query = ListaPrecios::find()
                 ->joinWith('prodLista')
                 ->joinWith('prodLista.tipoProd')
                 ->joinWith('prodLista.marca')
                 ->where('sucursal_lista = :sucursal')
                 ->addParams([':sucursal' => $sucursal])
                 ->orderBy('desc_tpdcto, desc_marca, des_prod, cod_prod');

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


        $dataProvider->sort->attributes['codigo'] = [
            'asc' => ['producto.cod_prod' => SORT_ASC],
            'desc' => ['producto.cod_prod' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['descripcion'] = [
            'asc' => ['producto.id_prod' => SORT_ASC],
            'desc' => ['producto.id_prod' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tipo_prod'] = [
            'asc' => ['tipo_producto.id_tpdcto' => SORT_ASC],
            'desc' => ['tipo_producto.id_tpdcto' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['marca'] = [
            'asc' => ['marca.id_marca' => SORT_ASC],
            'desc' => ['marca.id_marca' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id_lista' => $this->id_lista,
            'tipo_lista' => $this->tipo_lista,
            'producto.id_prod' => $this->descripcion,
            'tipo_producto.id_tpdcto' => $this->tipo_prod,
            'marca.id_marca' => $this->marca,
            'precio_lista' => $this->precio_lista,
            'sucursal_lista' => $this->sucursal_lista,
        ]);

        $query->andFilterWhere(['like', 'producto.cod_prod', $this->codigo]);

        return $dataProvider;
    }
}
