<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProveedor */

$this->title = Yii::t('tipo_proveedor','Supplier type: <span class="label label-primary">{number}</span> {name}',[
  'number' => $model->id_tprov,
  'name' => $model->des_tprov
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_proveedor', 'Tipo Proveedors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-proveedor-view">
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
                'id_tprov',
                'des_tprov',
                [
                  'attribute' => 'status_tprov',
                  'format' => 'raw',
                  'value' => $model->status_tprov ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
            ],
        ]) ?>
      </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
