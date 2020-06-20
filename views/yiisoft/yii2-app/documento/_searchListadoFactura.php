<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use app\models\Cliente;
use app\models\TipoDocumento;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoSearch */
/* @var $form yii\widgets\ActiveForm */
$primerDiaMes = date('01/MM/yyyy'); // hard-coded '01' for first day
$ultimoDiaMes  = date('dd/MM/yyyy');
?>

<div class="documento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['listado-factura'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'cod_doc',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-barcode"></i>']]])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'fecha_doc',[
            'addClass' => 'form-control ',
            // 'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-calendar"></i>']]
          ])->widget(DateRangePicker::classname(), [
              'useWithAddon'=>true,
              'presetDropdown'=>true,
              'convertFormat'=>true,
              // 'includeMonthsFilter'=>true,
              'pluginOptions' => [
                    'locale' => ['format' => 'd/m/Y'],
                    'maxDate' => $ultimoDiaMes,
                    'showDropdowns'=>true
              ],
              'options' => ['placeholder' => Yii::t( 'app', 'Select range' )."..." ],
              // 'pluginEvents' => [
              //         "apply.daterangepicker" => "function() { aplicarDateRangeFilter() }",
              // ],
          ]) ?>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?= $form->field($model, 'tipoDocumento',[
            'addClass' => 'form-control ',
            ])->widget(Select2::classname(), [
              'data' => TipoDocumento::getTipoDocumentoList(NULL, TipoDocumento::ES_DOCUMENTO),
              // 'initValueText' => ,
              'language' => Yii::$app->language,
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']],
              'options' => [
                'placeholder' => Yii::t('tipo_documento','Select a type').'...',
              ],
              'theme' => Select2::THEME_DEFAULT,
              'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
              ],
              ]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?= $form->field($model, 'cliente',[
            'addClass' => 'form-control ',
            ])->widget(Select2::classname(), [
              'data' => Cliente::getClienteList(),
              // 'initValueText' => ,
              'language' => Yii::$app->language,
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']],
              'options' => [
                'placeholder' => Yii::t('cliente','Select a customer').'...',
              ],
              'theme' => Select2::THEME_DEFAULT,
              'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
              ],
              ]) ?>
      </div>
  </div>


    <!-- <?= $form->field($model, 'pedido_doc') ?> -->


    <?php // echo $form->field($model, 'obsv_doc') ?>

    <?php // echo $form->field($model, 'totalimp_doc') ?>

    <?php // echo $form->field($model, 'totaldsc_doc') ?>

    <?php // echo $form->field($model, 'total_doc') ?>

    <?php // echo $form->field($model, 'status_doc') ?>

    <?php // echo $form->field($model, 'sucursal_doc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
