<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoTrasladoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motivo-traslado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_motivo') ?>

    <?= $form->field($model, 'des_motivo') ?>

    <?= $form->field($model, 'status_motivo') ?>

    <?= $form->field($model, 'sucursal_motivo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('motivo_traslado', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('motivo_traslado', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
