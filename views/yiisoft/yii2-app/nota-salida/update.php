<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotaSalida */

$this->title = Yii::t('tipo_movimiento', 'Update Nota Salida: {name}', [
    'name' => $model->id_trans,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_movimiento', 'Nota Salidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trans, 'url' => ['view', 'id' => $model->id_trans]];
$this->params['breadcrumbs'][] = Yii::t('tipo_movimiento', 'Update');
?>
<div class="nota-salida-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
