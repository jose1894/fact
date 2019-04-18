<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distrito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'des_dtto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'depto_dtto')->textInput() ?>

    <?= $form->field($model, 'status_dtto')->textInput() ?>

    <?= $form->field($model, 'sucursal_dtto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('distrito', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
