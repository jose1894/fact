<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDetalle */

$this->title = Yii::t('pedido', 'Update Pedido Detalle: {name}', [
    'name' => $model->id_pdetalle,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Pedido Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pdetalle, 'url' => ['view', 'id' => $model->id_pdetalle]];
$this->params['breadcrumbs'][] = Yii::t('pedido', 'Update');
?>
<div class="pedido-detalle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
