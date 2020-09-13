<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedida */

$this->title = Yii::t('unidad_medida', 'Update unit of measurement: {number} / {name}', [
	'number' => $model->id_und,
    'name' => $model->des_und,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('unidad_medida', 'Unidad Medidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_und, 'url' => ['view', 'id' => $model->id_und]];
$this->params['breadcrumbs'][] = Yii::t('unidad_medida', 'Update');
?>
<div class="unidad-medida-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
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
