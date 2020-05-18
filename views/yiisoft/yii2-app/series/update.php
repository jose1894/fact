<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */

$this->title = Yii::t('serie', 'Update serie: <span class="label label-primary">{number}</span> {name}', [
    'number' => $model->id_serie,
    'name' => $model->des_serie
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('serie', 'Serie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_serie, 'url' => ['view', 'id' => $model->id_serie]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="serie-update">
  <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= $this->title ?>
        </h3>
      </div>
      <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>
  </div>
</div>
