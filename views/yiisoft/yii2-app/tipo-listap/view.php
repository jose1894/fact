<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoListap */

$this->title = $model->id_lista;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_listap', 'Tipo Listaps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-listap-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('tipo_listap', 'Update'), ['update', 'id' => $model->id_lista], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('tipo_listap', 'Delete'), ['delete', 'id' => $model->id_lista], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('tipo_listap', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_lista',
            'desc_lista',
            'estatus_lista',
            'sucursal_lista',
        ],
    ]) ?>

</div>
