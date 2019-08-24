<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use app\models\CompraDetalleSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = Yii::t('compra', 'Purchase order: {number} / {name}', [
    'number' => $model->cod_compra
    'name' => $model->proveeCompra->nombre_prove
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('compra', 'Purchase order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="compra-view">
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
                  'attribute' => 'cod_compra',
                  'labelColOptions'=>['style'=>'width:10%'],
                ],
                [
                  'labelColOptions'=>['style'=>'width:10%'],
                  'attribute' => 'fecha_compra',
                  'value' => Yii::$app->formatter->asDate($model->fecha_compra, 'dd/MM/yyyy')
                ],
                [
                  'labelColOptions'=>['style'=>'width:10%'],
                  //'valueColOptions'=>['style'=>'width:30%'],
                  'attribute' => 'provee_compra',
                  'value' => $model->proveeCompra->nombre_prove,
                  'width' => '80%',
                ],
                [
                  'labelColOptions'=>['style'=>'width:10%'],
                  //'valueColOptions'=>['style'=>'width:30%'],
                  'attribute' => 'moneda_compra',
                  'value' => $model->monedaCompra->des_moneda,
                  'width' => '80%',
                ],
                [
                  'labelColOptions'=>['style'=>'width:10%'],
                  //'valueColOptions'=>['style'=>'width:30%'],
                  'attribute' => 'condp_compra',
                  'value' => $model->condpCompra->desc_condp,
                  'width' => '80%',
                ],
                [
                  'attribute' => 'nrodoc_compra',
                  'labelColOptions'=>['style'=>'width:10%'],
                ],
              ],
          ]) ?>
          <h3><?= Yii::t('producto', 'Products')?> </h3>
          <hr>
          <?php
          $detalles = new CompraDetalleSearch;
          $detalles->compra_cdetalle = $model->id_compra;
          $dataProvider = $detalles->search([  ]);

          echo  GridView::widget([
              'dataProvider' => $dataProvider,
              'summary' => '',
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  [
                    'attribute'=>'prod_cdetalle',
                    'value' => function($data){
                         return $data->prodCdetalle->des_prod;
                    },
                    'width' => '80%'
                  ],
                  [
                    'attribute'=>'cant_cdetalle',
                    'width' => '30%'
                  ],
                ],

          ]);

          ?>

        </div>
      </div>
    </div>
</div>
