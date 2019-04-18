<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */

$this->title = $model->id_dtto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('distrito', 'Distritos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="distrito-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('distrito', 'Update'), ['update', 'id' => $model->id_dtto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('distrito', 'Delete'), ['delete', 'id' => $model->id_dtto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('distrito', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_dtto',
            'des_dtto',
            'depto_dtto',
            'status_dtto',
            'sucursal_dtto',
        ],
    ]) ?>

</div>
