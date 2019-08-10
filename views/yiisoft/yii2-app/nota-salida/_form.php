<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotaSalida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nota-salida-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_trans')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_trans')->textInput() ?>

    <?= $form->field($model, 'obsv_trans')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tipo_trans')->textInput() ?>

    <?= $form->field($model, 'docref_trans')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'almacen_trans')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_movimiento', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
