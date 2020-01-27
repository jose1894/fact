<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */

$this->title = $model->id_doc;
$this->params['breadcrumbs'][] = ['label' => Yii::t('documento', 'Documentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('documento', 'Update'), ['update', 'id' => $model->id_doc], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('documento', 'Delete'), ['delete', 'id' => $model->id_doc], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('documento', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_doc',
            'cod_doc',
            'tipo_doc',
            'pedido_doc',
            'fecha_doc',
            'obsv_doc:ntext',
            'totalimp_doc',
            'totaldsc_doc',
            'total_doc',
            'status_doc',
            'sucursal_doc',
        ],
    ]) ?>

</div>
