<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ListaPrecios */

$this->title = $model->id_lista;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lista_precios', 'Lista Precios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lista-precios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('lista_precios', 'Update'), ['update', 'id' => $model->id_lista], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('lista_precios', 'Delete'), ['delete', 'id' => $model->id_lista], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('lista_precios', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_lista',
            'tipo_lista',
            'prod_lista',
            'precio_lista',
            'sucursal_lista',
        ],
    ]) ?>

</div>
