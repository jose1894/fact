<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedida */

$this->title = Yii::t('unidad_medida',"Unit of measurement: <span class='label label-primary'>{number}</span> {name}",[
  'number' => $model->id_und,
  'name' => $model->des_und
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('unidad_medida', 'Unidad Medidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="unidad-medida-view">
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
                'id_und',
                'des_und',
                'sunatm_und',
                [
                  'attribute' => 'status_und',
                  'format' => 'raw',
                  'value' => $model->status_und ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
            ],
        ]) ?>
        </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
