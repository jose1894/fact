<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProveedor */

$this->title = Yii::t('tipo_proveedor', 'Update supplier type: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_tprov,
  'name' => $model->des_tprov,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_proveedor', 'Tipo Proveedors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tprov, 'url' => ['view', 'id' => $model->id_tprov]];
$this->params['breadcrumbs'][] = Yii::t('tipo_proveedor', 'Update');
?>
<div class="tipo-proveedor-update">
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
