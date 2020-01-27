<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoTraslado */

$this->title = Yii::t('motivo_traslado', 'Update transfer reason: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_motivo,
    'name' => $model->des_motivo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('motivo_traslado', 'Motivo de traslado'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_motivo];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-movimiento-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
          <?= $this->render('_form', [
              'model' => $model,
          ]) ?>
        </div>
      </div>
    </div>
</div>
