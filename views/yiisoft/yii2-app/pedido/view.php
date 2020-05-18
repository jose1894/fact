<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\models\PedidoDetalleSearch;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('pedido', 'Order: {number} / {name}', [
    'number' => $model->cod_pedido .' - '. $tipo,
    'name' => $model->cltePedido->nombre_clte,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedido-view">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= $this->title ?>
      </h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  [
                    'attribute' => 'cod_pedido',
                    'labelColOptions'=>['style'=>'width:10%'],
                  ],
                  [
                    'labelColOptions'=>['style'=>'width:10%'],
                    'attribute' => 'fecha_pedido',
                    'value' => Yii::$app->formatter->asDate($model->fecha_pedido, 'dd/MM/yyyy')
                  ],
                  [
                    'labelColOptions'=>['style'=>'width:10%'],
                    //'valueColOptions'=>['style'=>'width:30%'],
                    'attribute' => 'clte_pedido',
                    'value' => $model->cltePedido->nombre_clte,
                    'width' => '80%',
                  ],
                  [
                    'labelColOptions'=>['style'=>'width:10%'],
                    'attribute' => 'vend_pedido',
                    'value' => $model->vendPedido->nombre_vend,
                    'width' => '80%',
                  ],
                  [
                    'labelColOptions'=>['style'=>'width:10%'],
                    'attribute' => 'moneda_pedido',
                    'value' => $model->monedaPedido->des_moneda,
                  ],
                  [
                    'labelColOptions'=>['style'=>'width:10%'],
                    'attribute' => 'almacen_pedido',
                    'value' => $model->almacenPedido->des_almacen
                  ]
              ],
          ]) ?>
          <h3><?= Yii::t('producto', 'Products')?> </h3>
          <hr>
          <?php
          $detalles = new PedidoDetalleSearch;
          $detalles->pedido_pdetalle = $model->id_pedido;
          $dataProvider = $detalles->search([  ]);

          echo  GridView::widget([
              'dataProvider' => $dataProvider,
              'summary' => '',
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  [
                    'attribute'=>'prod_pdetalle',
                    'value' => function($data){
                         return $data->productoPdetalle->des_prod;
                    },
                    'width' => '50%'
                  ],
                  [
                    'attribute'=>'cant_pdetalle',
                    'width' => '10%'
                  ],
                  [
                    'attribute'=>'precio_pdetalle',
                    'width' => '10%'
                  ],
                  [
                    'attribute'=>'descu_pdetalle',
                    'width' => '10%'
                  ],
                  [
                    'attribute'=>'total_pdetalle',
                    'width' => '20%'
                  ],
                ],

          ]);

          ?>

        </div>
      </div>
    </div>
</div>
