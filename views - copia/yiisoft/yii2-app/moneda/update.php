<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */

$this->title = Yii::t('moneda', 'Update currency: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_moneda,
  'name' => $model->des_moneda,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('moneda', 'Monedas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_moneda, 'url' => ['view', 'id' => $model->id_moneda]];
$this->params['breadcrumbs'][] = Yii::t('moneda', 'Update');
?>
<div class="moneda-update">
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
