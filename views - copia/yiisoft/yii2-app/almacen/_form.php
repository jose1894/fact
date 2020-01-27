<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Almacen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="almacen-form">
    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'des_almacen',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'status_almacen',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          [1 => 'Activo', 0 => 'Inactivo'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
