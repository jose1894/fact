<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>

    <?= $form->field($model, 'id_empresa')->textInput() ?>

    <?= $form->field($model, 'nombre_empresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus_empresa')->textInput() ?>

    <?= $form->field($model, 'dni_empresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruc_empresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipopers_empresa')->textInput() ?>

    <?= $form->field($model, 'tlf_empresa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direcc_empresa')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('empresa', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
