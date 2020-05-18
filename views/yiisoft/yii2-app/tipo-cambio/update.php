<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCambio */

$this->title = Yii::t('tipo_cambio', 'Update Tipo Cambio: {name}', [
    'name' => $model->id_tipoc,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_cambio', 'Tipo Cambios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipoc, 'url' => ['view', 'id' => $model->id_tipoc]];
$this->params['breadcrumbs'][] = Yii::t('tipo_cambio', 'Update');
?>
<div class="tipo-cambio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
