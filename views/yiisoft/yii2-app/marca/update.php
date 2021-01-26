<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */

$this->title = Yii::t('marca', 'Update make: {number} / {name}', [
	'number' => $model->id_marca,
  'name' => $model->desc_marca,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('marca', 'make'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_marca, 'url' => ['view', 'id' => $model->id_marca]];
$this->params['breadcrumbs'][] = Yii::t('marca', 'Update');
?>
<div class="marca-update">
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
