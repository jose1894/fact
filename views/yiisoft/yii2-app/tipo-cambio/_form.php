<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCambio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-cambio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_tipoc')->textInput() ?>

    <?= $form->field($model, 'monedac_tipoc')->textInput() ?>

    <?= $form->field($model, 'moneda_tipoc')->textInput() ?>

    <?= $form->field($model, 'cambioc_tipoc')->textInput() ?>

    <?= $form->field($model, 'venta_tipoc')->textInput() ?>

    <?= $form->field($model, 'valorf_tipoc')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_cambio', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
