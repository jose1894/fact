<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Almacen */

$this->title = Yii::t('almacen', 'Update warehouse: {number} / {name}', [
	'number' => $model->id_almacen,
  'name' => $model->des_almacen,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('almacen', 'Almacens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_almacen, 'url' => ['view', 'id' => $model->id_almacen]];
$this->params['breadcrumbs'][] = Yii::t('almacen', 'Update');
?>
<div class="almacen-update">
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
