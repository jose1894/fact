<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DocumentoSearch represents the model behind the search form of `app\models\Documento`.
 */
class DocumentoSearch extends Documento
{
    public $cliente;
    public $tipoDocumento;
    public $docNoEsGuia = true;
    public $anulado = false;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_doc', 'tipo_doc', 'pedido_doc', 'status_doc', 'sucursal_doc','cliente'], 'integer'],
            [['cod_doc', 'fecha_doc', 'obsv_doc','status_doc','cliente','tipo_doc','tipoDocumento','$docNoEsGuia'], 'safe'],
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
        $query = Documento::find()
                 ->joinWith(['pedidoDoc'])
                 ->joinWith('pedidoDoc.cltePedido')
                 ->joinWith('tipoDoc');

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['cliente'] = [
            'asc' => ['cliente.nombre_clte' => SORT_ASC],
            'desc' => ['cliente.nombre_clte' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tipoDocumento'] = [
            'asc' => ['tipo_documento.des_tipod' => SORT_ASC],
            'desc' => ['tipo_documento.des_tipod' => SORT_DESC],
        ];


        $this->load($params);
        $this->sucursal_doc = $sucursal;

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_doc' => $this->id_doc,
            // 'tipo_doc' => $this->tipo_doc,
            'pedido_doc' => $this->pedido_doc,
            // 'fecha_doc' => $this->fecha_doc,
            'totalimp_doc' => $this->totalimp_doc,
            'totaldsc_doc' => $this->totaldsc_doc,
            'total_doc' => $this->total_doc,
            'sucursal_doc' => $this->sucursal_doc,
        ]);


        $query->andFilterWhere(['like', 'cod_doc', $this->cod_doc])
            ->andFilterWhere(['like', 'obsv_doc', $this->obsv_doc])
            ->andFilterWhere(['in', 'status_doc', $this->status_doc])
            ->andFilterWhere(['=', 'pedido.clte_pedido', $this->cliente]);

        if ( is_array($this->tipoDocumento) ) {
          $query->andFilterWhere(['in', 'tipo_doc', $this->tipoDocumento]);
        } else {
          $query->andFilterWhere(['tipo_doc' => $this->tipoDocumento]);
        }

        if ( $this->docNoEsGuia ) {
          $query->andFilterWhere(['not in', 'tipo_doc', Documento::TIPODOC_GUIA]);
        }

        //Condicional para la fecha, verifica si es rango o solo una fecha
        if ( !empty($this->fecha_doc) ) {
          $fechaDoc = explode(" - ", $this->fecha_doc);
          $fechaDocInicio = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[0]))->format('Y-m-d');
          $fechaDocFin = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[1]))->format('Y-m-d');
          $query->andFilterWhere(['between', 'fecha_doc', $fechaDocInicio, $fechaDocFin]);
        }


        if ( $this->anulado ) {
            $query->andFilterWhere(['=', 'statussunat_doc',-1]);
            $query->andFilterWhere(['<>', 'status_doc',Documento::DOCUMENTO_ANULADO]);

            $noEsTipoDoc = "";
            if ( $this->docNoEsGuia ) {
              $noEsTipoDoc = [Documento::TIPODOC_GUIA];
            }

            $fechaDocInicio = "";
            $fechaDocFin    = "";

            if ( !empty($this->fecha_doc) ) {
              $fechaDoc = explode(" - ", $this->fecha_doc);
              $fechaDocInicio = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[0]))->format('Y-m-d');
              $fechaDocFin = \DateTime::createFromFormat('d/m/Y', trim($fechaDoc[1]))->format('Y-m-d');
            }

            $query->orFilterWhere(['and',
                ['in', 'tipo_doc', $this->tipoDocumento],
                ['not in', 'tipo_doc', $noEsTipoDoc],
                ['<>', 'status_doc', Documento::DOCUMENTO_ANULADO],
                ['between', 'fecha_doc', $fechaDocInicio, $fechaDocFin],
                ['<', 'datediff(curdate(),fecha_doc)', 7],
                ['=', 'pedido.clte_pedido', $this->cliente],
                ['=', 'sucursal_doc', $this->sucursal_doc]
              ]);
        }
        // echo $query->createCommand()->sql;
        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchDocumento($params)
    {
        $sucursal = Yii::$app->user->identity->profiles->sucursal;
        $query = Documento::find()->joinWith(['pedidoDoc'])->joinWith('pedidoDoc.cltePedido')
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

    /* Selecciona el conteo total de facturas generadas */
    public static function showCountFactura()
    {
        $sucursal = Yii::$app->user->identity->profiles->sucursal;
        $query = Documento::find()
                // ->select( ["COUNT(*) as total"] )
                ->where('sucursal_doc = :sucursal',[':sucursal' => $sucursal])
                ->andWhere(['status_doc' => [Documento::DOCUMENTO_GENERADO]])
                ->andWhere('tipo_doc = :tipo',[':tipo' => Documento::TIPODOC_FACTURA])
                ->andWhere('fecha_doc = "' . date('Y-m-d') . '"')
                ->all();

      return $dataProvider = new ActiveDataProvider([
           'query' => $query,
       ]);
    } /* fin de funcion showCountFactura*/

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchListadoAnular($params)
    {
        $sucursal = Yii::$app->user->identity->profiles->sucursal;
        $query = Documento::find()->joinWith(['pedidoDoc'])->joinWith('pedidoDoc.cltePedido')
                 ->where([
                            'sucursal_doc'    => $sucursal,
                            'tipo_doc'        => [Documento::TIPODOC_FACTURA, Documento::TIPODOC_BOLETA,NotaCredito::TIPODOC_NCREDITO],
                            'status_doc'      =>[Documento::DOCUMENTO_GENERADO],
                            'statussunat_doc' => -1
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
    }/* searchListadoAnular */
}
