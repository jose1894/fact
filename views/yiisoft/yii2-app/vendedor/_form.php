<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Zona;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendedor-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'dni_vend',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']]
        ])->textInput(['maxlength' => true,'placeholder' => Yii::t('vendedor','Input a DNI')]) ?>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <?= $form->field($model, 'nombre_vend',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]]
          )->textInput(['maxlength' => true, 'placeholder' => Yii::t('vendedor','Input a name')]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'tlf_vend',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-phone"></i>']]]
          )->textInput(['maxlength' => true, 'placeholder' => Yii::t('vendedor','Input a phone number')]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'estatus_vend',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
          )->dropDownList(
                  [1 => 'Activo', 0 => 'Inactivo'],
                ['custom' => true, 'prompt' => Yii::t('app','Select...')]
          ) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?php
        $zonas = Zona::find()->where(['estatus_zona' => 1])
        ->orderBy('nombre_zona')
        ->all();
        $zonas=ArrayHelper::map($zonas,'id_zona','nombre_zona');
        ?>
        <?= $form->field($model, 'zona_vend',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
          )->dropDownList(
                $zonas,
                ['custom' => true, 'prompt' => Yii::t('app','Select...')])
           ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
