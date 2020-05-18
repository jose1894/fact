<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCambioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-cambio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_tipoc') ?>

    <?= $form->field($model, 'fecha_tipoc') ?>

    <?= $form->field($model, 'monedac_tipoc') ?>

    <?= $form->field($model, 'moneda_tipoc') ?>

    <?= $form->field($model, 'cambioc_tipoc') ?>

    <?php // echo $form->field($model, 'venta_tipoc') ?>

    <?php // echo $form->field($model, 'valorf_tipoc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_cambio', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tipo_cambio', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
