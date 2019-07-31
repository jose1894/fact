<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = $model->id_compra;
$this->params['breadcrumbs'][] = ['label' => Yii::t('compra', 'Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="compra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('compra', 'Update'), ['update', 'id' => $model->id_compra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('compra', 'Delete'), ['delete', 'id' => $model->id_compra], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('compra', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_compra',
            'cod_compra',
            'fecha_compra',
            'provee_compra',
            'moneda_compra',
            'condp_compra',
            'usuario_compra',
            'estatus_compra',
            'edicion_compra',
            'nrodoc_compra',
            'sucursal_compra',
        ],
    ]) ?>

</div>
