<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pais-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    		<?= $form->field($model, 'cod_pais',[
          					'addClass' => 'form-control ',
          					'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-barcode"></i>']]])->textInput(['maxlength' => true,'placeholder' => Yii::t('pais','Input a code')."..."]) ?>
    	</div>
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<?= $form->field($model, 'des_pais',[
          		'addClass' => 'form-control ',
          		'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true,'placeholder' => Yii::t('pais','Input a name')."..."]) ?>
    	</div>
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    		<?= $form->field($model, 'status_pais',[
          		'addClass' => 'form-control ',
          		'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          		[1 => 'Activo', 0 => 'Inactivo'],
          		['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
    	</div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
