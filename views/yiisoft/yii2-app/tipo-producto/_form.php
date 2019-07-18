<?php

use yii\helpers\Html;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-producto-form">
  <?php $modeluser = User::findOne(Yii::$app->user->id);
  print_r($modeluser->sucursal0->id_suc);?>
  <h1></h1>
    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <?= $form->field($model, 'desc_tpdcto',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'status_tpdcto',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          [1 => 'Activo', 0 => 'Inactivo'],
          ['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
