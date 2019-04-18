<?php

use yii\helpers\Html;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">
  <div class="container-fluid">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'dni_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']]
        ])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'ruc_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']]
        ])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'nombre_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]
        ])->textInput(['maxlength' => true]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?= $form->field($model, 'direcc_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-file-text"></i>']]
        ])->textarea(['rows' => 6]) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">        
          <?= $form->field($model, 'pais_cte')->textInput() ?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?= $form->field($model, 'depto_cte')->textInput() ?>        
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?= $form->field($model, 'provi_cte')->textInput() ?>        
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?= $form->field($model, 'dtto_clte')->textInput() ?>        
      </div>
    </div>


    <div class="row">      
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'tlf_ctle')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'vendedor_clte')->textInput() ?>
        </div>
    </div>
    <div class="row">      
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'estatus_ctle',[
            'addClass' => 'form-control ',
            'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]
            ])->dropDownList(
              [1 => 'Activo', 0 => 'Inactivo'],
              ['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'condp_clte')->textInput() ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

  </div>
</div>
