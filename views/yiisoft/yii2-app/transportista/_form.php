<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transportista */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transportista-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'des_transp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_transp')->textInput() ?>

    <?= $form->field($model, 'sucursal_transp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('transportista', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
