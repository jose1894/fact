<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_doc')->textInput() ?>

    <?= $form->field($model, 'pedido_doc')->textInput() ?>

    <?= $form->field($model, 'fecha_doc')->textInput() ?>

    <?= $form->field($model, 'obsv_doc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'totalimp_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totaldsc_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_doc')->textInput() ?>

    <?= $form->field($model, 'sucursal_doc')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('documento', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
