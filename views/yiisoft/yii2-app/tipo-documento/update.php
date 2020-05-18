<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_documento', 'Update document type: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_tipod,
    'name' => $model->des_tipod,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_documento', 'Document type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipod, 'url' => ['view', 'id' => $model->id_tipod]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-documento-update">
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
