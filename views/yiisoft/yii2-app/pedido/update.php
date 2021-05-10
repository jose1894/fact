<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('pedido', 'Update order: {number} / {name}', [
    'number' => $model->cod_pedido . " - " . $tipo,
    'name' => $model->cltePedido->nombre_clte,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cod_pedido . " - " . $tipo ." / ". $model->cltePedido->nombre_clte];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedido-update">
  <!-- <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body"> -->
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalles' => $modelsDetalles,
        'IMPUESTO' => $IMPUESTO,
    ]) ?>
    <!-- </div>
  </div> -->
</div>
