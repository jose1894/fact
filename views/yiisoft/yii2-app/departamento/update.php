<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Departamento */

$this->title = Yii::t('departamento', 'Update estate / department: {number} / {name}', [
  'number' => $model->id_depto,
  'name' => $model->des_depto
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('departamento', 'Estate / Department'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_depto, 'url' => ['view', 'id' => $model->id_depto]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="departamento-update">
  <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= Html::encode($this->title) ?>
        </h3>
      </div>
      <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>
  </div>
</div>
