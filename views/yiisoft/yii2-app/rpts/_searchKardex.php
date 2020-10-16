<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use app\models\Producto;
use app\models\TipoDocumento;
use app\models\Documento;
use yii\web\View ;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoSearch */
/* @var $form yii\widgets\ActiveForm */
$primerDiaMes = date('01/MM/yyyy'); // hard-coded '01' for first day
$ultimoDiaMes  = date('dd/MM/yyyy');
?>
<div class="kardex-search">

  <?php $form = ActiveForm::begin([
      'action' => ['rpts/kardex'],
      'method' => 'get',
      'options' => [
          'data-pjax' => true
      ],
  ]); ?>
  <div class="row">
    <div class="col-lg-6 col-xs-12">
      <?= $form->field($model, 'id_prod',[
        'addClass' => 'form-control ',
        'addon' => [
					'prepend' => ['content'=>'<i class="fa fa-barcode"></i>']
					]
		])->widget(Select2::classname(), [
            'data' => Producto::getProductoList(),
            'initValueText' => null,
            'language' => Yii::$app->language,
            'options' => [
            				'allowClear' => true,
            				'placeholder' => Yii::t('producto','Select a product').'...',
            ],
      			'changeOnReset' => true,
            'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => [
                    'allowClear' => true,
            ],
    ]) ?>
    </div>
    <div class="col-lg-6 col-xs-12">
      <?= $form->field($model, 'fecha_trans',[
          'addClass' => 'form-control ',
          // 'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-calendar"></i>']]
        ])->widget(DateRangePicker::classname(), [
            'useWithAddon'=>true,
            'presetDropdown'=>true,
            'convertFormat'=>true,
            'includeMonthsFilter'=>true,
            //'language' => Yii::$app->language,
            'pluginOptions' => [
                  'locale' => ['format' => 'd/m/Y'],
                  'showDropdowns'=> true,
                  'maxDate' => date('d/m/Y'),
            ],
            'options' => ['placeholder' => Yii::t( 'app', 'Select range' )."..." ],

        ]) ?>
      </div>

      <?php /*
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
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
            ]) */?>
      </div>
      <hr>
      <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search"></i> '. Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('<i class="fa fa-refresh"></i> ' . Yii::t('app','Refresh '), ['kardex'], ['class' => 'btn btn-success btn-flat'])?>
      </div>
</div>
<?php ActiveForm::end(); ?>
