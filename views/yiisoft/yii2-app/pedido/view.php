<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = $model->id_pedido;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('pedido', 'Update'), ['update', 'id' => $model->id_pedido], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('pedido', 'Delete'), ['delete', 'id' => $model->id_pedido], [
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
            'id_pedido',
            'cod_pedido',
            'fecha_pedido',
            'clte_pedido',
            'vend_pedido',
            'moneda_pedido',
            'almacen_pedido',
            'usuario_pedido',
            'estatus_pedido',
            'sucursal_pedido',
        ],
    ]) ?>

</div>
