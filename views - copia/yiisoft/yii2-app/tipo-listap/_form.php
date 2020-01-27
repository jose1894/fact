<?php

use yii\helpers\Html;
use yii\web\View ;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoListap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-listap-form">
    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-sm-6 col-xs-12">
        <?= $form->field($model, 'desc_lista')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-sm-6 col-xs-12">
        <?= $form->field($model, 'estatus_lista',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
          )->dropDownList(
                  [1 => 'Activo', 0 => 'Inactivo'],
                ['custom' => true, 'prompt' => Yii::t('app','Select...')]
          ) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
