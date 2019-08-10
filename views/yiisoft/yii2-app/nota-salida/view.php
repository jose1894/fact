<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\NotaSalida */

$this->title = $model->id_trans;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_movimiento', 'Nota Salidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nota-salida-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('tipo_movimiento', 'Update'), ['update', 'id' => $model->id_trans], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('tipo_movimiento', 'Delete'), ['delete', 'id' => $model->id_trans], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('tipo_movimiento', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_trans',
            'codigo_trans',
            'fecha_trans',
            'obsv_trans:ntext',
            'tipo_trans',
            'docref_trans',
            'almacen_trans',
        ],
    ]) ?>

</div>
