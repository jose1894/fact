<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moneda-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'des_moneda',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'sunatm_moneda',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'tipo_moneda',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-money"></i>']]])->dropDownList(
          ['N' => 'Nacional', 'E' => 'Extranjero'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'status_moneda',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          [1 => 'Activo', 0 => 'Inactivo'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
