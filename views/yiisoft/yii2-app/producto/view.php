<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title =  Yii::t('producto','Product: <span class="label label-primary">{number}</span> {name}',[
  'number' => $model->id_prod,
  'name' => $model->des_prod
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('producto', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="producto-view">
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
                'id_prod',
                'cod_prod',
                'des_prod',
                [
                  'attribute' => 'tipo_prod',
                  'value' => $model->tipoProd->desc_tpdcto
                ],
                [
                  'attribute' => 'umed_prod',
                  'value' => $model->umedProd->des_und
                ],
                'contenido_prod',
                [
                  'attribute' => 'exctoigv_prod',
                  'format' => 'raw',
                  'value' => $model->exctoigv_prod ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                [
                  'attribute' => 'compra_prod',
                  'format' => 'raw',
                  'value' => $model->compra_prod ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                [
                  'attribute' => 'venta_prod',
                  'format' => 'raw',
                  'value' => $model->venta_prod ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                'stockini_prod',
                'stockmax_prod',
                'stockmin_prod',
                [
                  'attribute' => 'status_prod',
                  'format' => 'raw',
                  'value' => $model->status_prod ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                //'sucursal_prod',
            ],
        ]) ?>
      </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
