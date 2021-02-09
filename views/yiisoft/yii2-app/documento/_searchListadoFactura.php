<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use app\models\Cliente;
use app\models\Vendedor;
use app\models\TipoDocumento;
use app\models\Documento;
use yii\web\View ;

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
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'fecha_doc',[
            'addClass' => 'form-control ',
            // 'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-calendar"></i>']]
          ])->widget(DateRangePicker::classname(), [
              'useWithAddon'=>true,
              'presetDropdown'=>true,
              'convertFormat'=>true,
              'includeMonthsFilter'=>true,
              'pluginOptions' => [
                    'locale' => ['format' => 'd/m/Y'],
                    'maxDate' => date('d/m/Y'),
                    'showDropdowns'=>true
              ],
              'options' => ['placeholder' => Yii::t( 'app', 'Select range' )."..." ],
              // 'pluginEvents' => [
              //         "apply.daterangepicker" => "function() { aplicarDateRangeFilter() }",
              // ],
          ]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'status_doc',[
            'addClass' => 'form-control ',
            'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]
          ])->dropDownList([
            // '' => '',
            Documento::DOCUMENTO_GENERADO => 'GENERADO',
            Documento::DOCUMENTO_ANULADO => 'ANULADO'
          ],
          ['prompt' => Yii::t('app','Select...')]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
  </div>
  <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?= $form->field($model, 'cliente',[
            'addClass' => 'form-control ',
            ])->widget(Select2::classname(), [
              'data' => Cliente::getClienteList(),
              // 'initValueText' => ,
              'language' => Yii::$app->language,
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-user"></i>']],
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
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'vendedor',[
          'addClass' => 'form-control ',
          ])->widget(Select2::classname(), [
            'data' => Vendedor::getVendedoresList(),
            // 'initValueText' => ,
            'language' => Yii::$app->language,
            'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-user"></i>']],
            'options' => [
              'placeholder' => Yii::t('vendedor','Select a seller').'...',
            ],
            'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => [
              'allowClear' => true,
              'multiple' => true
            ],
            ]) ?>
  </div>
</div>
<div class="form-group">
  <?= Html::submitButton('<i class="fa fa-search"></i> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-flat btn-primary']) ?>
  <?= Html::a('<i class="fa fa-refresh"></i> ' . Yii::t('app','Refresh '), ['listado-factura'], ['class' => 'btn btn-flat btn-success'])?>
</div>
<hr>
<?php ActiveForm::end();
$js = <<<JS
$('#reset').on('click', function(e) {
  e.preventDefault();
  console.log('reset');
  $( '.range-value' ).trigger('cancel.daterangepicker');
  $( '#documentosearch-tipodocumento' ).val(null).trigger("change");
  $( '#documentosearch-cliente' ).val(null).trigger("change");
  $( '#documentosearch-status_doc' ).val(null).trigger("change");
});

$('.range-value').on('cancel.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  $('.range-value').val('');
});
JS;
$this->registerJs($js,View::POS_LOAD);
