<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */

$this->title = Yii::t('vendedor', 'Update seller: {number} / {name}', [
    'number' => $model->id_vendedor,
    'name' => $model->nombre_vend
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('vendedor', 'Sellers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_vendedor, 'url' => ['view', 'id' => $model->id_vendedor]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vendedor-update">
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
