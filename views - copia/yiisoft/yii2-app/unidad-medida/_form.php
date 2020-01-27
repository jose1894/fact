<?php

use yii\helpers\Html;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm

/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidad-medida-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'des_und',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'sunatm_und',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'status_und',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          [1 => 'Activo', 0 => 'Inactivo'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
