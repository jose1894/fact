<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use app\models\Departamento;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provincia-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'des_prov',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]]
          )->textInput(['maxlength' => true, 'placeholder' => Yii::t('provincia','Input a name')]) ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?php
        $paises=Pais::getPaisList();
        ?>
        <?= $form->field($model, 'pais_prov',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
          )->widget(Select2::classname(), [
                    'data' => $paises,
                    'language' => Yii::$app->language,                  
                    'options' => ['placeholder' => Yii::t('pais','Select a country').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ]) ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?php
        $provs = Departamento::getDeptoList( $model->depto_prov );
        echo Html::hiddenInput('provincia-selected_depatamento', $model->depto_prov, ['id' => 'provincia-selected_departamento']);
        ?>
        <?= $form->field($model, 'depto_prov',[
          'addClass' => 'form-control'
          ])->widget(DepDrop::classname(), [
              'options' => ['placeholder' => Yii::t('app','Select...')],
              'type' => DepDrop::TYPE_SELECT2,
              'select2Options' => [
                  'language' => Yii::$app->language,
                  'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[]
              ],
              'pluginOptions' => [
                  'initialize' => true,
                  'depends' => ['provincia-pais_prov'],
                  'url' => Url::to(['/departamento/departamentos']),
                  'loadingText' => Yii::t('departamento','Loading departments').'...',
                  'params' => ['distrito-selected_provincia']
              ]
          ])?>
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
