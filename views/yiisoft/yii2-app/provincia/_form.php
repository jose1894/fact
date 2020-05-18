<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provincia-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'des_prov',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]]
          )->textInput(['maxlength' => true, 'placeholder' => Yii::t('provincia','Input a name')]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?php        
        $paises=Pais::getPaisList();
        ?>
        <?= $form->field($model, 'pais_prov',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
          )->dropDownList(
                $paises,
                ['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'status_prov',[
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
