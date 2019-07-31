<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('pedido', 'Update order: {number} / {name}', [
    'number' => $model->id_pedido,
    'name' => $model->cltePedido->nombre_clte,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pedido, 'url' => ['view', 'id' => $model->id_pedido]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedido-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalles' => $modelsDetalles,
        'IMPUESTO' => $IMPUESTO
    ]) ?>
    </div>
  </div>
</div>
