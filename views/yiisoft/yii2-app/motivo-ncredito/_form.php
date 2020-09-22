<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoNcredito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motivo-ncredito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_motivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'des_motivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_motivo')->textInput() ?>

    <?= $form->field($model, 'sucursal_motivo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('motivo_ncredito', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
