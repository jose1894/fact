<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('pedido', 'Order: {number} / {name}', [
    'number' => $model->id_pedido,
    'name' => $model->cltePedido->nombre_clte,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_pedido], ['class' => 'btn btn-flat btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'attribute' => 'cod_pedido',
              'labelColOptions'=>['style'=>'width:10%'],
            ],
            [
              'labelColOptions'=>['style'=>'width:10%'],
              'attribute' => 'fecha_pedido',
              'value' => Yii::$app->formatter->asDate($model->fecha_pedido, 'dd/MM/yyyy')
            ],
            [
              'labelColOptions'=>['style'=>'width:10%'],
              //'valueColOptions'=>['style'=>'width:30%'],
              'attribute' => 'clte_pedido',
              'value' => $model->cltePedido->nombre_clte,
              'width' => '80%',
            ],
            [
              'labelColOptions'=>['style'=>'width:10%'],
              'attribute' => 'vend_pedido',
              'value' => $model->vendPedido->nombre_vend,
              'width' => '80%',
            ],
            [
              'labelColOptions'=>['style'=>'width:10%'],
              'attribute' => 'moneda_pedido',
              'value' => $model->monedaPedido->des_moneda,
            ],
            [
              'labelColOptions'=>['style'=>'width:10%'],
              'attribute' => 'almacen_pedido',
              'value' => $model->almacenPedido->des_almacen
            ]
        ],
    ]) ?>

</div>
