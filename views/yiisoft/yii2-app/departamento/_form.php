<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Departamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamento-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="form-group">
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?php
            $paises=Pais::getPaisList();
            ?>
            <?= $form->field($model, 'pais_depto',[
              'addClass' => 'form-control'
              ])->widget(Select2::classname(), [
                        'data' => $paises,
                        'language' => Yii::$app->language,
                        'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                        'options' => ['placeholder' => Yii::t('pais','Select a country').'...'],
                        'theme' => Select2::THEME_DEFAULT,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                ])?>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'cod_depto',[
              'addClass' => 'form-control ',
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-barcode"></i>']]]
              )->textInput(['maxlength' => true, 'placeholder' => Yii::t('departamento','Input a code')]) ?>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'des_depto',[
              'addClass' => 'form-control ',
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]]
              )->textInput(['maxlength' => true, 'placeholder' => Yii::t('departamento','Input a name')]) ?>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'status_depto',[
              'addClass' => 'form-control ',
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
              )->dropDownList(
                      [1 => 'Activo', 0 => 'Inactivo'],
                    ['custom' => true, 'prompt' => Yii::t('app','Select...')]
              ) ?>
          </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
/*$this->registerJs('
debugger;
  if ( $("#departamento-prov_depto").text().trim() !== "'.Yii::t('app','Select...').'" ){
    $("#departamento-des_depto").attr("readonly",false);
  }
',View::POS_READY);*/
