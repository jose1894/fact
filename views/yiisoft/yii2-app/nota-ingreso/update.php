<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('ingreso', 'Update entry note: {number}', [
    'number' => $model->id_trans,
    //'name' => $model->nombre_trans,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ingreso', 'Entry note'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trans, 'url' => ['view', 'id' => $model->id_trans]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedido-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalles' => $modelsDetalles,
    ]) ?>
    </div>
  </div>
</div>
