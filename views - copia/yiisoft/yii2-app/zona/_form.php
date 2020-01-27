<?php

use yii\helpers\Html;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm

/* @var $this yii\web\View */
/* @var $model app\models\Zona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zona-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-sm-8 col-xs-12">
        <?= $form->field($model, 'nombre_zona',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]
          ])->textInput(['maxlength' => true,'placeholder' => Yii::t('zona','Input a name')]) ?>
      </div>
      <div class="col-sm-4 col-xs-12">
        <?= $form->field($model, 'estatus_zona',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
          )->dropDownList(
                [1 => 'Activo', 0 => 'Inactivo'],
                ['custom' => true, 'prompt' => Yii::t('app','Select...')]
          ) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?= $form->field($model, 'desc_zona',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-file-text"></i>']]
          ])->textarea(['rows' => 6,'placeholder' => Yii::t("zona","Input a description")."..."]) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
