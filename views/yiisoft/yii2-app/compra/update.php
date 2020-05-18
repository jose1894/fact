<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = Yii::t('compra', 'Update purchase order: {number} / {name}', [
    'number' => $model->cod_compra,
    'name' => $model->proveeCompra->nombre_prove,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('compra', 'Purchase order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cod_compra. ' / '. $model->proveeCompra->nombre_prove, 'url' => ['view', 'id' => $model->id_compra]];
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
