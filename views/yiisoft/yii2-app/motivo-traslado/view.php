<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('motivo_traslado', 'Update transfer reason: {number} / {name}', [
	'number' => $model->id_tipom,
    'name' => $model->des_tipom,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('motivo_traslado', 'Motivo de traslado'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipom, 'url' => ['view', 'id' => $model->id_tipom]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="motivo-traslado-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
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
