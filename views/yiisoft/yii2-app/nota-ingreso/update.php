<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotaIngreso */

$this->title = Yii::t('tipo_movimiento', 'Update Nota Ingreso: {name}', [
    'name' => $model->id_trans,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_movimiento', 'Nota Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trans, 'url' => ['view', 'id' => $model->id_trans]];
$this->params['breadcrumbs'][] = Yii::t('tipo_movimiento', 'Update');
?>
<div class="nota-ingreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
