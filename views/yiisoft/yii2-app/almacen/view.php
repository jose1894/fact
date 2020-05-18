<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Almacen */

$this->title = Yii::t('almacen','Warehouse: <span class="label label-primary">{number}</span> {name}',[
  'number' => $model->id_almacen,
  'name' => $model->des_almacen
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('almacen', 'Almacens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="almacen-view">
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
                'id_almacen',
                'des_almacen',
                //'status_almacen',
                [
                  'attribute' => 'status_almacen',
                  'format' => 'raw',
                  'value' => $model->status_almacen ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                //'sucursal_almacen',
            ],
        ]) ?>
      </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
