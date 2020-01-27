<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCambio */

$this->title = $model->id_tipoc;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_cambio', 'Tipo Cambios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-cambio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('tipo_cambio', 'Update'), ['update', 'id' => $model->id_tipoc], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('tipo_cambio', 'Delete'), ['delete', 'id' => $model->id_tipoc], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('tipo_cambio', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_tipoc',
            'fecha_tipoc',
            'monedac_tipoc',
            'moneda_tipoc',
            'cambioc_tipoc',
            'venta_tipoc',
            'valorf_tipoc',
        ],
    ]) ?>

</div>
