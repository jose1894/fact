<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use app\models\Provincia;
use app\models\Departamento;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distrito-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?php
          $paises=Pais::getPaisList();
          ?>
          <?= $form->field($model, 'pais_dtto',[
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
          <?php
          echo Html::hiddenInput('distrito-selected_depatamento', $model->depto_dtto, ['id' => 'distrito-selected_depatamento']);
          ?>
          <?= $form->field($model, 'depto_dtto',[
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
                    'depends' => ['distrito-pais_dtto'],
                    'url' => Url::to(['/departamento/departamentos']),
                    'loadingText' => Yii::t('departamento','Loading departments').'...',
                    'params' => ['distrito-selected_depatamento']
                ]
            ])?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?php
          echo Html::hiddenInput('distrito-selected_provincia', $model->prov_dtto, ['id' => 'distrito-selected_provincia']);
          ?>
          <?= $form->field($model, 'prov_dtto',[
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
                    'depends' => ['distrito-depto_dtto'],
                    'url' => Url::to(['/provincia/provincias']),
                    'loadingText' => Yii::t('provincia','Loading provinces').'...',
                    'params' => ['distrito-selected_provincia']
                ]
            ]) ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?= $form->field($model, 'cod_dtto',[
            'addClass' => 'form-control'
            ])->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?= $form->field($model, 'des_dtto',[
            					'addClass' => 'form-control ',
            					'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?= $form->field($model, 'status_dtto',[
            		'addClass' => 'form-control ',
            		'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
            		[1 => 'Activo', 0 => 'Inactivo'],
            		['custom' => true, 'prompt' => Yii::t('app','Select...')])  ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
