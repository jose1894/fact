<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Numeracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="numeracion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_num')->textInput() ?>

    <?= $form->field($model, 'numero_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sucursal_num')->textInput() ?>

    <?= $form->field($model, 'serie_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_num')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('numeracion', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
