<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoNcredito */

$this->title = Yii::t('motivo_ncredito', 'Update Motivo Ncredito: {name}', [
    'name' => $model->id_motivo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('motivo_ncredito', 'Motivo Ncreditos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_motivo, 'url' => ['view', 'id' => $model->id_motivo]];
$this->params['breadcrumbs'][] = Yii::t('motivo_ncredito', 'Update');
?>
<div class="motivo-ncredito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
