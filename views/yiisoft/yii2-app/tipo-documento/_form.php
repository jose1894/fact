<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoDocumento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-documento-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>

    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <?= $form->field($model, 'des_tipod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true])  ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'abrv_tipod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true])  ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'ope_tipod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          ['E' => 'Entrada', 'S' => 'Salida', 'N' => 'Ninguno'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'tipo_tipod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          [0 => 'ES PEDIDO', 1 => 'ES DOCUMENTO', 2 => 'ES GUIA'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'status_tipod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          [1 => 'Activo', 0 => 'Inactivo'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
