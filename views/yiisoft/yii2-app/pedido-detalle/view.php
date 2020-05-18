<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDetalle */

$this->title = $model->id_pdetalle;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Pedido Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedido-detalle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('pedido', 'Update'), ['update', 'id' => $model->id_pdetalle], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('pedido', 'Delete'), ['delete', 'id' => $model->id_pdetalle], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('pedido', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pdetalle',
            'prod_pdetalle',
            'cant_pdetalle',
            'precio_pdetalle',
            'descu_pdetalle',
            'impuesto_pdetalle',
            'status_pdetalle',
            'pedido_pdetalle',
        ],
    ]) ?>

</div>
