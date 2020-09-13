<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Departamento */

$this->title = Yii::t('departamento','Department / County / Municipality: {number} / {name}', [
  'number' => $model->id_depto,
  'name' => $model->des_depto
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('departamento', 'Department / County / Municipality'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="departamento-view">
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
              'id_depto',
              'des_depto',
              [
                'attribute' => 'pais_depto',
                'value' => $model->paisDepto->des_pais
              ],
              [
                'attribute' => 'prov_depto',
                'value' => $model->provDepto->des_prov
              ],
              [
                'attribute' => 'status_depto',
                'format' => 'raw',
                'value' => $model->status_depto ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
              ],
              //'sucursal_depto',
          ],
      ]) ?>
      </div>
    </div>
  </div>
</div>
