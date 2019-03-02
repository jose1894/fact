<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = $model->dni_empresa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('empresa', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empresa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('empresa', 'Update'), ['update', 'id' => $model->dni_empresa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('empresa', 'Delete'), ['delete', 'id' => $model->dni_empresa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('empresa', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_empresa',
            'nombre_empresa',
            'estatus_empresa',
            'dni_empresa',
            'ruc_empresa',
            'tipopers_empresa',
            'tlf_empresa',
            'direcc_empresa:ntext',
        ],
    ]) ?>

</div>
