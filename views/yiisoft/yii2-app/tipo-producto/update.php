<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_producto', 'Update product type: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_tpdcto,
    'name' => $model->desc_tpdcto,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_producto', 'Product type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tpdcto, 'url' => ['view', 'id' => $model->id_tpdcto]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-producto-update">
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
