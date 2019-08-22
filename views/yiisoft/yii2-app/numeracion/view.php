<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Numeracion */

$this->title = $model->id_num;
$this->params['breadcrumbs'][] = ['label' => Yii::t('numeracion', 'Numeracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="numeracion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('numeracion', 'Update'), ['update', 'id' => $model->id_num], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('numeracion', 'Delete'), ['delete', 'id' => $model->id_num], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('numeracion', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_num',
            'tipo_num',
            'numero_num',
            'sucursal_num',
            'serie_num',
            'status_num',
        ],
    ]) ?>

</div>
