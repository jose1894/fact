<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transportista */

$this->title = Yii::t('transportista', 'Update carrier: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_transp,
  'name' => $model->des_transp,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('transportista', 'Carrier'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_transp, 'url' => ['view', 'id' => $model->id_transp]];
$this->params['breadcrumbs'][] = Yii::t('transportista', 'Update');
?>
<div class="transportista-update">
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
