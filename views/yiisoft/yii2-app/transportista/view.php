<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transportista */

$this->title = $model->id_transp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('transportista', 'Transportistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transportista-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('transportista', 'Update'), ['update', 'id' => $model->id_transp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('transportista', 'Delete'), ['delete', 'id' => $model->id_transp], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('transportista', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_transp',
            'des_transp',
            'status_transp',
            'sucursal_transp',
        ],
    ]) ?>

</div>
