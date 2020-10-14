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
    public $descripcion;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista', 'tipo_lista', 'prod_lista', 'sucursal_lista', 'descripcion'], 'integer'],
            [['precio_lista'], 'number'],
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
        $query = ListaPrecios::find()                
                 ->joinWith('prodLista')
                 ->where('sucursal_lista = :sucursal')                 
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

        
        $dataProvider->sort->attributes['descripcion'] = [
            'asc' => ['producto.id_prod' => SORT_ASC],
            'desc' => ['producto.id_prod' => SORT_DESC],
        ];

        // grid filtering conditions 
        $query->andFilterWhere([
            'id_lista' => $this->id_lista,
            'tipo_lista' => $this->tipo_lista,
            'producto.id_prod' => $this->descripcion,
            'precio_lista' => $this->precio_lista,
            'sucursal_lista' => $this->sucursal_lista,
        ]);

        return $dataProvider;
    }
}
