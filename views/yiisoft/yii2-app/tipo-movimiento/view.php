<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_movimiento','Movement type: <span class="label label-primary">{number}</span> {name}',[
  'number' => $model->id_tipom,
  'name' => $model->des_tipom
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_movimiento', 'Movement type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-movimiento-view">
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
                  'id_tipom',
                  'des_tipom',
                  //'status_tipom',
                  [
                    'attribute' => 'status_tipom',
                    'format' => 'raw',
                    'value' => $model->status_tipom ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                  ],
              ],
          ]) ?>
        </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
