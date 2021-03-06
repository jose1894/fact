<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_movimiento','Movement type: {number} / {name}',[
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
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">

          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  'id_tipom',
                  'des_tipom',
                  [
                    'attribute' => 'tipo_tipom',
                    'format' => 'raw',
                    'value' => $model->tipo_tipom == 'E' ? Yii::t('tipo_movimiento', 'Entry') : Yii::t('tipo_movimiento', 'Exit')
                  ],
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
