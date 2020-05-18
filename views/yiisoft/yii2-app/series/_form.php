<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\web\View ;

/* @var $this yii\web\View */
/* @var $model app\models\Series */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="serie-form">

    <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript'=>true]); ?>

    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <?= $form->field($model, 'des_serie',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]]
          )->textInput(['maxlength' => true, 'placeholder' => Yii::t('serie','Input a description')]) ?>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'status_serie',[
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
