<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Zona */

$this->title = Yii::t('zona', 'Update zone: {number} / {name}', [
  'name' => $model->nombre_zona,
  'number' => $model->id_zona,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('zona', 'Zones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_zona, 'url' => ['view', 'id' => $model->id_zona]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="zona-update">
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
