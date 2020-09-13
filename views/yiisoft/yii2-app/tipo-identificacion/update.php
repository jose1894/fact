<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_identificacion', 'Update id type: {number} / {name}', [
	'number' => $model->id_tipoi,
    'name' => $model->des_tipoi,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_identificacion', 'Id type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipoi, 'url' => ['view', 'id' => $model->id_tipoi]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-identificacion-update">
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
