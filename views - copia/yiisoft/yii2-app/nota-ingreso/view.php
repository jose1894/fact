<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use app\models\NotaIngresoDetalleSearch;
/* @var $this yii\web\View */
/* @var $model app\models\NotaIngreso */

$this->title = Yii::t('ingreso', 'Entry note: {number}', [
    'number' => $model->codigo_trans,
    //'name' => $model->nombre_trans,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ingreso', 'Entry note'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nota-ingreso-view">
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
                    //'id_trans',
                    [
                      'attribute' => 'codigo_trans',
                      'labelColOptions'=>['style'=>'width:10%'],
                    ],
                    [
                      'labelColOptions'=>['style'=>'width:10%'],
                      'attribute' => 'fecha_trans',
                      'value' => Yii::$app->formatter->asDate($model->fecha_trans, 'dd/MM/yyyy')
                    ],
                    [
                      'labelColOptions'=>['style'=>'width:10%'],
                      'attribute' => 'docref_trans',
                      'value' => $model->docref_trans,
                    ],
                    [
                      'labelColOptions' => [ 'style' => 'width:10%' ],
                      'attribute' => 'tipo_trans',
                      'value' => $model->tipoTrans->des_tipom,
                    ],
                    [
                      'labelColOptions' => [ 'style' => 'width:10%' ],
                      'attribute' => 'almacen_trans',
                      'value' => $model->almacenTrans->des_almacen,
                    ],
                    [
                      'labelColOptions'=>['style'=>'width:10%'],
                      'attribute' => 'obsv_trans',
                      'obsv_trans:ntext',
                    ],

                ],
            ]) ?>
            <h3><?= Yii::t('producto', 'Products')?> </h3>
            <hr>
            <?php
            $detalles = new NotaIngresoDetalleSearch;
            $detalles->trans_detalle = $model->id_trans;
            $dataProvider = $detalles->search([  ]);

            echo  GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                      'attribute'=>'prod_detalle',
                      'value' => function($data){
                           return $data->prodDetalle->des_prod;
                      },
                      'width' => '80%'
                    ],
                    [
                      'attribute'=>'cant_detalle',
                      'width' => '30%'
                    ],
                  ],

            ]);

            ?>

          </div>
        </div>
      </div>
</div>
