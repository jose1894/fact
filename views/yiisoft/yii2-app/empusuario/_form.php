<?php

use app\models\Empresa;
use yii\helpers\Html;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['disabled' => true]) ?>


    <?= $form->field($model, 'empresa')
        ->widget(Select2::classname(), [
              'data' => Empresa::empresaList(),
              'language' => Yii::$app->language,
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
              'options' => ['placeholder' => Yii::t('empresa','Select a company').'...'],
              'theme' => Select2::THEME_DEFAULT,
              'pluginOptions' => [
                  'allowClear' => true
              ],
      ]) ?>

    <?php
        $sucursales = [];
        if ( !empty( $model->empresa ) ){
          $modelEmpresa = Empresa::findModel( $model->empresa )->sucursales;
          $sucursales = $modelEmpresa->sucursales;
          $sucursales = ArrayHelper::map($sucursales,'id_suc','des_suc');
        }
        echo Html::hiddenInput('user-selected_sucursal', $model->sucursal, ['id' => 'user-selected_sucursal']);

    ?>
    <?= $form->field($model, 'sucursal')
        ->widget(DepDrop::classname(), [
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
                  'depends' => ['user-empresa'],
                  'url' => Url::to(['/empresa/sucursales']),
                  'loadingText' => Yii::t('empresa','Loading branches').'...',
                  'params' => ['user-selected_sucursal']
              ]
      ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
