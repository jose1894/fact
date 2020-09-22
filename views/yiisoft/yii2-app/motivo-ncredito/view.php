<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoNcredito */

$this->title = $model->id_motivo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('motivo_ncredito', 'Motivo Ncreditos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="motivo-ncredito-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('motivo_ncredito', 'Update'), ['update', 'id' => $model->id_motivo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('motivo_ncredito', 'Delete'), ['delete', 'id' => $model->id_motivo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('motivo_ncredito', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_motivo',
            'cod_motivo',
            'des_motivo',
            'status_motivo',
            'sucursal_motivo',
        ],
    ]) ?>

</div>
