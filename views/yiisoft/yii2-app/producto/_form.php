<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\models\TipoProducto;
use app\models\TipoListap;
use app\models\UnidadMedida;
use yii\helpers\ArrayHelper;
use yii\web\View ;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\checkbox\CheckboxX;
use wbraganca\dynamicform\DynamicFormWidget;
use app\base\Model;
use kartik\number\NumberControl;



/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true ]); ?>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'cod_prod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-barcode"></i>']]])->textInput(['maxlength' => true,'placeholder' => Yii::t('producto','Input a code')]) ?>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <?= $form->field($model, 'des_prod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-edit"></i>']]])->textInput(['maxlength' => true,'placeholder' => Yii::t('producto','Input a description')]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?php
          $tipos = TipoProducto::find()->where(['status_tpdcto' => 1])
          ->orderBy('desc_tpdcto')
          ->all();
          $tipos=ArrayHelper::map($tipos,'id_tpdcto','desc_tpdcto');
        ?>
        <?= $form->field($model, 'tipo_prod',[
          'addClass' => 'form-control'
          ])->widget(Select2::classname(), [
                    'data' => $tipos,
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                    'options' => ['placeholder' => Yii::t('tipo_producto','Select a type').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?php
          $unidades = UnidadMedida::find()->where(['status_und' => 1])
          ->orderBy('des_und')
          ->all();
          $unidades = ArrayHelper::map($unidades,'id_und','des_und');
        ?>
        <?= $form->field($model, 'umed_prod',[
          'addClass' => 'form-control'
          ])->widget(Select2::classname(), [
                    'data' => $unidades,
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                    'options' => ['placeholder' => Yii::t('unidad_medida','Select a unit').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ]) ?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'contenido_prod',[
          'addClass' => 'form-control',
          'addon' => [ 'prepend' => ['content'=>'#']]
          ])->textInput( ['type' => 'number','style'=>'text-align:right'] ) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-lg- col-md-2 col-sm-2 col-xs-12">
              <label></label>
              <?= $form->field($model, 'exctoigv_prod',[
                                'addClass' => 'form-control'
                                ])->widget(CheckboxX::classname(), [
                                         'initInputType' => CheckboxX::INPUT_CHECKBOX,
                                         'autoLabel' => true,
                                         'pluginOptions'=>[
                                                            'threeState'=>false,
                                                            'inline' => false,
                                                            'theme' => 'krajee-flatblue',
                                                            'enclosedLabel' => true,
                                                          ]
                                     ])->label(false) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <label></label>
            <?= $form->field($model, 'compra_prod',[
                              'addClass' => 'form-control'
                              ])->widget(CheckboxX::classname(), [
                                       'initInputType' => CheckboxX::INPUT_CHECKBOX,
                                       'autoLabel' => true,
                                       'pluginOptions'=>[
                                                         'threeState'=>false,
                                                         'inline' => true,
                                                         'theme' => 'krajee-flatblue',
                                                         'enclosedLabel' => true,
                                                       ]
                                   ])->label(false) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <label></label>
            <?= $form->field($model, 'venta_prod',[
                              'addClass' => 'form-control'
                              ])->widget(CheckboxX::classname(), [
                                       'initInputType' => CheckboxX::INPUT_CHECKBOX,
                                       'autoLabel' => true,
                                       'pluginOptions'=>[
                                                          'threeState'=>false,
                                                          'theme' => 'krajee-flatblue',
                                                          'enclosedLabel' => true,
                                                          'inline' => true
                                                        ]
                                   ])->label(false) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'stockmin_prod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'#']]])->textInput([ 'type' => 'number','style'=>'text-align:right' ]) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'stockmax_prod',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'#']]
        ])->textInput(['type' => 'number', 'style'=>'text-align:right']) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'status_prod',[
              'addClass' => 'form-control ',
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
              [1 => 'Activo', 0 => 'Inactivo'],
              ['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
      </div>
    </div>

    <?php
    $listas = TipoListap::find()->where(['estatus_lista' => 1])
    ->orderBy('desc_lista')
    ->all();
    $listas=ArrayHelper::map($listas,'id_lista','desc_lista');
    ?>

    <!-- Listas de precios -->
    <div class="row">
      <div class="col-lg-12">
        <?php DynamicFormWidget::begin([
              'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
              'widgetBody' => '.table-body', // required: css class selector
              'widgetItem' => '.detalle-item', // required: css class
              //'limit' => 10, // the maximum times, an element can be cloned (default 999)
              'min' => 0, // 0 or 1 (default 1)
              'insertButton' => '.add-item', // css class
              'deleteButton' => '.remove-item', // css class
              'model' => $modelsListaP[0],
              'formId' => $model->formName(),
              'formFields' => [
                  'tipo_lista',
                  'prod_lista',
                  'precio_lista'
              ],
          ]); ?>

                <table class="table table-stripped" style="width:100%">
                  <thead>
                    <label><?= Yii::t('lista_precios','List prices') ?></label>
                    <tr>
                      <td><label><?= Yii::t('tipo_listap','List price type') ?></label></td>
                      <td><label><?= Yii::t('lista_precios','Local currency price') ?></label></td>
                      <td><label><?= Yii::t('lista_precios','Foreign exchange price') ?></label></td>
                      <td><label><?= Yii::t('lista_precios','Utility 1') ?></label></td>
                      <td><label><?= Yii::t('lista_precios','Utility 2') ?></label></td>
                      <td><label><?= Yii::t('lista_precios','List price') ?></label></td>
                      <td>
                        <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                        <div class="clearfix"></div>
                      </td>
                    </tr>
                  </thead>
                  <tbody class="table-body"><!-- widgetContainer -->
                    <?php foreach ($modelsListaP as $index => $modelListaP): ?>
                            <tr class="detalle-item"><!-- widgetBody -->
                              <?php
                                // necessary for update action.
                                if (!$modelListaP->isNewRecord) {
                                    echo Html::activeHiddenInput($modelListaP, "[{$index}]id_lista");
                                    //$modelSucursal->empresa_suc[$index] = $model->id_empresa;
                                    //echo Html::activeHiddenInput($modelListaP, "[{$index}]pedido_pdetalle");
                                }
                              ?>
                              <td>

                                <?= $form->field($modelListaP, "[{$index}]tipo_lista",[
                                  'addClass' => 'form-control ',
                                  'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]]
                                  )->dropDownList(
                                        $listas,
                                        ['custom' => true, 'prompt' => Yii::t('app','Select...')])->label(false) ?>

                              </td>
                              <td>
                                <?= $form->field($modelListaP,"[{$index}]preciom_lista")
                                ->widget(NumberControl::classname(), [
                                      'maskedInputOptions' => [
                                          'allowMinus' => false
                                      ]
                                  ])->label(false)?>
                              </td>
                              <td>
                                <?= $form->field($modelListaP,"[{$index}]preciod_lista")->widget(NumberControl::classname(), [
                                      'maskedInputOptions' => [
                                          'allowMinus' => false
                                      ]
                                  ])->label(false)?>
                              </td>
                              <td>
                                <?= $form->field($modelListaP,"[{$index}]utilidad1_lista",[
                                  'addClass' => 'form-control ',
                                  'addon' => [ 'prepend' => ['content'=>'%']]
                                ])->widget(NumberControl::classname(), [
                                      'maskedInputOptions' => [
                                          'allowMinus' => false
                                      ]
                                  ])->label(false)?>
                              </td>
                              <td>
                                <?= $form->field($modelListaP,"[{$index}]utilidad2_lista",[
                                  'addClass' => 'form-control ',
                                  'addon' => [ 'prepend' => ['content'=>'%']]
                                ])->widget(NumberControl::classname(), [
                                      'maskedInputOptions' => [
                                          'allowMinus' => false
                                      ]
                                  ])->label(false)?>
                              </td>
                              <td>
                                <?= $form->field($modelListaP,"[{$index}]precio_lista")->widget(NumberControl::classname(), [
                                      'maskedInputOptions' => [
                                          'allowMinus' => false
                                      ]
                                  ])->label(false)?>
                              </td>
                              <td>
                                <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                <div class="clearfix"></div>
                            </td>
                            </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
          <?php DynamicFormWidget::end(); ?>
        </div>
      </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = "
$( 'select[id$=\"-tipo_lista\"]' ).on( 'change', function( e ) {
  let row = $( this ).attr( \"id\" ).split( \"-\" );
  row = row[ 1 ];

  $( '#listaprecios-' + row + '-preciom_lista-disp').val( 0 );
  $( '#listaprecios-' + row + '-preciod_lista-disp').val( 0 );
  $( '#listaprecios-' + row + '-utilidad1_lista-disp').val( 0 );
  $( '#listaprecios-' + row + '-utilidad2_lista-disp').val( 0 );
  $( '#listaprecios-' + row + '-precio_lista-disp').val( 0 );
});

$( 'input[id$=\"-preciom_lista-disp\"]').on( 'change',  function() {
  let row = $( this ).attr( \"id\" ).split( \"-\" );
  row = row[ 1 ];

  //let util1 = $( '#listaprecios-' + row + '-utilidad1_lista-disp' ).val( );
  //let util2 = $( '#listaprecios-' + row + '-utilidad2_lista-disp' ).val( );
  let precioLista = $( this ).val( );
  /*
  if ( util1 ) {
    precioLista = ( ( precioLista * util1 ) / 100) + precioLista;
  }

  if ( util2 ) {
    precioLista = ( ( precioLista * util2 ) / 100) + precioLista;
  }*/

  precioLista = parseFloat( precioLista ).toFixed(2);
  $( '#listaprecios-' + row + '-precio_lista-disp' ).val( precioLista )
});

$( 'input[id$=\"-utility1_lista-disp\"]').on( 'change',  function() {
  let row = $( this ).attr( \"id\" ).split( \"-\" );
  row = row[ 1 ];

  let util1 = $( this ).val();
  let precioLista = $( '#listaprecios-' + row + '-preciom_lista-disp' ).val();
  if ( util1 ) {
    precioLista = ( ( precioLista * util1 ) / 100) + precioLista;
  }

  precioLista = parseFloat( precioLista ).toFixed(2);
  $( '#listaprecios-' + row + '-precio_lista-disp' ).val( precioLista );
});

$( 'input[id$=\"-utility2_lista-disp\"]').on( 'change',  function() {
  let row = $( this ).attr( \"id\" ).split( \"-\" );
  row = row[ 1 ];

  let util1 = $( '#listaprecios-' + row + '-utilidad1_lista-disp' ).val( );
  let util2 = $( this ).val();

  let precioLista = $( '#listaprecios-' + row + '-preciom_lista-disp' ).val();

  if ( util1 ) {
    precioLista = ( ( precioLista * util1 ) / 100) + precioLista;
  }

  if ( util2 ) {
    precioLista = ( ( precioLista * util2 ) / 100) + precioLista;
  }
  precioLista = parseFloat( precioLista ).toFixed(2);
  $( '#listaprecios-' + row + '-precio_lista-disp' ).val( precioLista );
});

";

$this->registerJs( $js, View::POS_LOAD);
