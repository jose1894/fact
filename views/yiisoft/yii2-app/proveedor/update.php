<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = Yii::t('proveedor', 'Update supplier: <span class="label label-primary">{number}</span> {name}', [
    'number' => $model->id_prove,
    'name' => $model->nombre_prove
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('proveedor', 'Proveedors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prove, 'url' => ['view', 'id' => $model->id_prove]];
$this->params['breadcrumbs'][] = Yii::t('proveedor', 'Update');
?>
<div class="proveedor-update">
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
