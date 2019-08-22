<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use app\models\TipoDocumento;

/* @var $this yii\web\View */
/* @var $model app\models\Numeracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="numeracion-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'tipo_num')->textInput() ?>
        <?php
          $mov = TipoDocumento::getTipoDocumento( );
        ?>
        <?= $form->field($model, 'tipo_num',[
            'addClass' => 'form-control'
          ])->widget(Select2::classname(), [
                    'data' => $mov,
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-exchange"></i>']],
                    'options' => ['placeholder' => Yii::t('tipo_documento','Select a type').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    // 'pluginOptions' => [
                    //     'allowClear' => true
                    // ],
            ]) ?>
      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'serie_num')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'numero_num',[
          'addClass' => 'form-control'
          ])->textInput([
            'maxlength' => true
            ]) ?>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'status_num')->textInput() ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
