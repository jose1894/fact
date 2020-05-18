<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDetalle */

$this->title = Yii::t('pedido', 'Create Pedido Detalle');
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Pedido Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-detalle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
