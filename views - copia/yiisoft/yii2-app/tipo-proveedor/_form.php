<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-proveedor-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <?= $form->field($model, 'des_tprov',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'status_tprov',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          [1 => 'Activo', 0 => 'Inactivo'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
