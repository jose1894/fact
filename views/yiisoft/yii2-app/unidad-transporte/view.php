<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedida */

$this->title = Yii::t('unidad_transporte','Transport unit: {number} / {name}',[
  'number' => $model->id_utransp,
  'name' => $model->des_utransp
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('unidad_transporte', 'Unidad Medidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="unidad-medida-view">
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
                'id_utransp',
                'des_utransp',
                [
                  'attribute' => 'status_utransp',
                  'format' => 'raw',
                  'value' => $model->status_utransp ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
            ],
        ]) ?>
        </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
