<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = Yii::t('producto', 'Update product: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_prod,
  'name' => $model->des_prod,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('producto', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prod, 'url' => ['view', 'id' => $model->id_prod]];
$this->params['breadcrumbs'][] = Yii::t('producto', 'Update');
?>
<div class="producto-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
        <?= $this->render('_form', [
            'model' => $model,
						'modelsListaP' => $modelsListaP
        ]) ?>
      </div>
    </div>
  </div>
</div>
