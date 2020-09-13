<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedida */

$this->title = Yii::t('unidad_transporte', 'Update transport unit: {number} / {name}', [
	'number' => $model->id_utransp,
    'name' => $model->des_utransp,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('unidad_transporte', 'Transport unit'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_utransp, 'url' => ['view', 'id' => $model->id_utransp]];
$this->params['breadcrumbs'][] = Yii::t('unidad_transporte', 'Update');
?>
<div class="unidad-medida-update">
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
