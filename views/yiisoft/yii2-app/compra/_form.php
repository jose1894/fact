<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Vendedor;
use app\models\Moneda;
use app\models\Almacen;
use app\models\CondPago;
use app\models\Producto;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\form\ActiveField;
use yii\web\View ;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use app\base\Model;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */
/* @var $form yii\widgets\ActiveForm */

if ( $model->isNewRecord ) {
  $model->cod_compra = "0000000000";
}
?>

<div class="compra-form">

  <div class="container-fluid">


      <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true]); ?>
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <?= $form
          ->field($model, 'cod_compra',['addClass' => 'form-control '])
          ->textInput(['maxlength' => true,'readonly' => true, 'style' => ['text-align' => 'rigth']]) ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <?php
            $model->fecha_compra = date('d/m/Y');
            echo $form->field($model, 'fecha_compra',[
              'addClass' => 'form-control ',
            ])->textInput([
                  'value' => date('d/m/Y'),
                  'readonly' => 'readonly',
                  'style' => ['text-align','rigth']
              ]) ?>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <?php
          $url = Url::to(['proveedor/proveedor-list']);
          $proveedor = empty($model->provee_compra) ? '' : Proveedor::findOne($model->provee_compra)->nombre_prov;
          echo $form->field($model, 'provee_compra',[
            'addClass' => 'form-control ',
            'hintType' => ActiveField::HINT_SPECIAL
            ])->widget(Select2::classname(), [
              'language' => Yii::$app->language,
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
              'initValueText' => $proveedor, // set the initial display text
              'options' => ['placeholder' => Yii::t('proveedor','Select a supplier').'...'],
              'theme' => Select2::THEME_DEFAULT,
              'pluginOptions' => [
                  //'allowClear' => true,
                  'minimumInputLength' => 3,
                  'language' => [
                      'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                      'inputTooShort' => new JsExpression("function() {  return '".Yii::t('app','Please input {number} or more characters', [ 'number'=> 3 ])."';}"),
                  ],
              'ajax' => [
                  'url' => $url,
                  'dataType' => 'json',
                  'data' => new JsExpression('function(params) { return {q:params.term}; }')
              ],
              'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
              'templateResult' => new JsExpression('function(proveedor) { return proveedor.text; }'),
              'templateSelection' => new JsExpression('function (proveedor) {
                  return proveedor.text;
                }'),
              ],
          ])
          ?>

          <?=  Html::hiddenInput("compra-tipo_listap", " ",['id'=>'proveedor-tipo_listap']); ?>
        </div>

      </div>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?php
            $monedas = Moneda::getMonedasList();
          ?>
          <?= $form->field($model, 'moneda_compra',[
          'addClass' => 'form-control ',
            ])->widget(Select2::classname(), [
                      'data' => $monedas,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-money"></i>']],
                      'options' => ['placeholder' => Yii::t('moneda','Select a currency').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      // 'pluginOptions' => [
                      //     'allowClear' => true
                      // ],
              ])?>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?php
            $condiciones = CondPago::getCondPagoList();
          ?>
          <?= $form->field($model, 'condp_compra',[
              'addClass' => 'form-control',
            ])->widget(Select2::classname(), [
                      'data' => $condiciones,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']],
                      'options' => ['placeholder' => Yii::t('condicionp','Select a payment condition').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      // 'pluginOptions' => [
                      //     'allowClear' => true,
                      // ],
              ])?>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?= $form->field($model, 'nrodoc_compra',[
              'addClass' => 'form-control'
            ])->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <label><?= Yii::t('app', 'Tax exemption')?></label>
          <?php
            echo $form->field($model, 'excento_compra',[
               'addClass' => 'form-control'
             ])->checkbox(['maxlength' => true])->label(false);
            ?>
        </div>
    </div>

    <!-- Articulos -->
    <div class="row">
      <div class="container-fluid">
        <?php  DynamicFormWidget::begin([
          'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
          'widgetBody' => '.table-body', // required: css class selector
          'widgetItem' => '.detalle-item', // required: css class
          //'limit' => 10, // the maximum times, an element can be cloned (default 999)
          'min' => 0, // 0 or 1 (default 1)
          'insertButton' => '.add-item', // css class
          'deleteButton' => '.remove-item', // css class
          'model' => $modelsDetalles[0],
          'formId' => $model->formName(),
          'formFields' => [
            'id_cdetalle',
            'prod_cdetalle',
            'cant_cdetalle',
            'precio_cdetalle',
            'descu_cdetalle',
            'impuesto_cdetalle',
            'status_cdetalle'
          ],
        ]); ?>
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <h5>Producto</H5>
          </div>
          <div class="col-sm-1 col-xs-12">
            <h5>Cantidad</h5>
          </div>
          <div class="col-sm-1 col-xs-12">
            <h5>Precio</h5>
          </div>
          <div class="col-sm-1 col-xs-12">
            <h5>Descuento</h5>
          </div>
          <div class="col-sm-2 col-xs-12">
            <h5>Total</h5>
          </div>
          <div class="col-sm-1 col-xs-12">
            <button type="button" class="pull-right add-item btn-flat btn btn-success btn-md" style="width:100%"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <hr>
        <div class="table-body">
          <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
            <div class="row detalle-item">
              <div class="col-sm-6 col-xs-12">
                <?php
                  // necessary for update action.
                  if (!$modelDetalle->isNewRecord) {
                      echo Html::activeHiddenInput($modelDetalle, "[{$index}]id_cdetalle");
                      //$modelSucursal->empresa_suc[$index] = $model->id_empresa;
                      echo Html::activeHiddenInput($modelDetalle, "[{$index}]pedido_cdetalle");
                  }
                  $url = Url::to(['producto/producto-list']);
                  $productos = empty($modelDetalle->prod_cdetalle) ? '' : Producto::findOne($modelDetalle->prod_cdetalle)->cod_prod.' '.Producto::findOne($modelDetalle->prod_cdetalle)->des_prod;
                  echo $form->field($modelDetalle, "[{$index}]prod_cdetalle",[
                    'addClass' => 'form-control input-sm',
                    ])->widget(Select2::classname(), [
                      'language' => Yii::$app->language,
                      'initValueText' => $productos, // set the initial display text
                      'options' => ['placeholder' => Yii::t('producto','Select a product').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      'pluginOptions' => [
                          //'allowClear' => true,
                          'minimumInputLength' => 3,
                          'language' => [
                              'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                              'inputTooShort' => new JsExpression("function() {  return '".Yii::t('app','Please input {number} or more characters', [ 'number'=> 3 ])."';}"),
                          ],
                      'ajax' => [
                          'url' => $url,
                          'dataType' => 'json',
                          'data' => new JsExpression('function(params) { return {desc:params.term,tipo_listap: $("#pedido-tipo_listap").val()}; }')
                      ],
                      'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                      'templateResult' => new JsExpression('function(producto) { return producto.text; }'),
                      'templateSelection' => new JsExpression('function (producto) {
                          return producto.text;
                        }'),
                      ],
                  ])->label(false);
                  ?>
              </div>
              <div class="col-sm-1 col-xs-12">
                <?= $form
                ->field($modelDetalle,"[{$index}]cant_cdetalle",[ 'addClass' => 'form-control b number-decimals'])
                ->textInput(['type' => 'number','min' => 0, 'step' => 1, 'placeholder' => Yii::t('compra' , 'Quantity')])
                ->label(false)?>
              </div>
              <div class="col-sm-1 col-xs-12">
                <?= $form
                ->field($modelDetalle,"[{$index}]precio_cdetalle",[ 'addClass' => 'form-control number-decimals'])
                ->textInput(['type' => 'number','min' => 0, 'step' => 1, 'placeholder' => Yii::t('compra' , 'Price')])
                ->label(false)?>
              </div>
              <div class="col-sm-1 col-xs-12">
                <?= $form
                ->field($modelDetalle,"[{$index}]descu_cdetalle",[ 'addClass' => 'form-control number-decimals'])
                ->textInput(['type' => 'number','min' => 0, 'step' => 1, 'placeholder' => Yii::t('compra' ,  'Discount')])
                ->label(false)?>
              </div>
              <div class="col-sm-2 col-xs-12">
                <?= $form
                ->field($modelDetalle,"[{$index}]total_cdetalle",[ 'addClass' => 'form-control number-decimals'])
                ->textInput(['type' => 'number','min' => 0, 'step' => 1, 'readonly'=> true,'placeholder' => Yii::t('compra', 'Total')])
                ->label(false)?>
              </div>
              <div class="col-sm-1 col-xs-12">
                <button type="button" class="remove-item btn btn-danger btn-flat btn-sm" style="width:100%"><i class="fa fa-trash"></i></button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php DynamicFormWidget::end(); ?>
        <hr>
        <table class="table table-fixed table-stripped">
          <tr>
            <td class="col-xs-6" style="text-align:right;">
              <?= Yii::t('app', 'Subtotal') ?>
            </td>
            <td class="col-xs-2">
              <input type="text" id="subtotal1" name="subtotal" readonly class="form-control totales" value="">
            </td>
          </tr>
          <tr>
            <td class="col-xs-6" style="text-align:right;">
              <?= Yii::t('app', 'Discount') ?>
            </td>
            <td class="col-xs-2">
              <input type="text" id="descuento" name="descuento" readonly class="form-control totales" value="">
            </td>
          </tr>
          <tr>
            <td class="col-xs-6" style="text-align:right;">
              <?= Yii::t('app', 'Subtotal') ?>
            </td>
            <td class="col-xs-2">
              <input type="text" id="subtotal2" name="subtotal" readonly class="form-control totales" value="">
            </td>
          </tr>
          <tr>
            <td class="col-xs-7" style="text-align:right;">
              <?= Yii::t('app', 'Tax')?> <?= $IMPUESTO ?>%
            </td>
            <td class="col-xs-2">
              <input type="text" name="impuesto" id="impuesto" readonly class="form-control totales" value="">
            </td>
          </tr>
          <tr>
            <td class="col-xs-6" style="text-align:right;">
              <?= Yii::t('app', 'Total')?>
            </td>
            <td class="col-xs-2">
              <input type="text" name="total" id="total" readonly  class="form-control totales" value="">
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- Articulos -->

    <div class="row">
      <div class="form-group">
        <?= Html::submitButton(Yii::t('compra', 'Save'), ['class' => 'btn btn-success']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
<?php
$this->registerJsFile(Yii::$app->getUrlManager()->getBaseUrl().'/js/dynamicform.js',
['depends'=>[\yii\web\JqueryAsset::className()],
'position'=>View::POS_END]);

$this->registerJsVar( "buttonPrint", "#imprimir" );
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);

Yii::$app->view->registerJs('const IMPUESTO = '. $IMPUESTO .' / 100;',  \yii\web\View::POS_HEAD);
$js = '

//Flat red color scheme for iCheck
$("#compra-excento_compra").iCheck({
  checkboxClass: "icheckbox_flat-green",
  radioClass   : "iradio_flat-green"
});

$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    //console.log("beforeInsert");
});
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    //console.log("afterInsert");
});
$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
  if ( confirm("'.Yii::t('producto','Are you sure to delete this product?').'") ) {
    return true;
  }
  return false;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
    calculateTotals( IMPUESTO );
});
$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});

$( buttonPrint ).on( "click", function(){
  $( frameRpt ).attr( "src", "'.Url::to(['compra/compra-rpt', 'id' => $model->id_compra]).'");
  $( modalRpt ).modal({
    backdrop: "static",
    keyboard: false,
  });
  $( modalRpt ).modal("show");
});

$( "#compra-provee_compra" ).on( "select2:select",function (e) {
  if (e.keyCode == 13) {
      $("#compra-moneda_compra").focus();
      $("#compra-moneda_compra").select2("open");
      e.preventDefault();
  }
});

$( ".table-body" ).on("select2:select","select[id$=\'prod_cdetalle\']",function() {
	let _currSelect = $( this );
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  let selects = $("select[id$=\'prod_cdetalle\']");

  if ( checkDuplicate( _currSelect, row, selects) ) {
    _currSelect.val( null ).trigger( "change" );
    swal( "Oops!!!","'. Yii::t('app','Code can´t be repeated, it is already in the list') .'","error" );
    _currSelect.focus();
  }

  $( "#compradetalle-" + row + "-cant_cdetalle" ).focus();

});

$( ".table-body" ).on( "keyup","input[id$=\'cant_cdetalle\']",function( e ) {
  if ( e.keyCode === 13 && $( this ).val() ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];

    $( "#compradetalle-" + row + "-precio_cdetalle" ).focus();

  }
});

$( ".table-body" ).on( "change", "input[id$=\'cant_cdetalle\']", function( e ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    let cant = $( this ).val();
    let precio = $( "#compradetalle-" + row + "-precio_cdetalle").val();
    let descu = $( "#compradetalle-" + row + "-descu_cdetalle").val();
    let total = 0.00;
    let descuento = 0;

    if ( cant ) {

      if ( descu ) {
        total = ( cant * ( precio - (precio * ( descu / 100 ) ) ) );
        descuento = ( precio * ( descu / 100 ) );
      } else {
        total = cant * precio;
      }

      total = parseFloat(  total  ).toFixed( 2 );
      $( "#compradetalle-" + row + "-total_cdetalle" ).val( total );
      $( "#compradetalle-" + row + "-descu_cdetalle").data( "descuento", descuento);

      calculateTotals( IMPUESTO );
    }
});

$( ".table-body" ).on( "keyup","input[id$=\'precio_cdetalle\']",function( e ) {
  if ( e.keyCode === 13 && $( this ).val() ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    $( "#compradetalle-" + row + "-descu_cdetalle" ).focus();

  }
});


$( ".table-body" ).on( "change", "input[id$=\'precio_cdetalle\']", function( e ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    let cant = $( "#compradetalle-" + row + "-cant_cdetalle").val();
    let descu = $( "#compradetalle-" + row + "-descu_cdetalle").val();
    let precio = $( this ).val();
    let total = 0;
    let descuento = 0;

    if ( cant ) {

      if ( descu ) {
        total = ( cant * ( precio - (precio * ( descu / 100 ) ) ) );
        descuento = ( precio * ( descu / 100 ) );
      } else {
        total = cant * precio;
      }

      total = parseFloat(  total  ).toFixed( 2 );
      $( "#compradetalle-" + row + "-total_cdetalle" ).val( total );
      $( "#compradetalle-" + row + "-descu_cdetalle").data( "descuento", descuento);

      calculateTotals( IMPUESTO );
    }

});

$( ".table-body" ).on( "keyup", "input[id$=\'descu_cdetalle\']", function( e ) {
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  if ( e.keyCode === 13 &&
      $( "#compradetalle-" + row + "-prod_cdetalle").val()  )  {

      swal({
        title: "' . Yii::t( 'app','Do you want to add a new item?') . '",
        icon: "info",
        buttons: true,
      }).then( ( willDelete ) => {
        if ( willDelete ) {
          let row = $( ".detalle-item" ).length;

          $( ".add-item" ).trigger( "click" );
          $( "#compradetalle-" + row + "-prod_cdetalle").focus();
          $( "#compradetalle-" + row + "-prod_cdetalle").select2("open");
        }
      });
  }
});


$( ".table-body" ).on( "change", "input[id$=\'descu_cdetalle\']", function( e ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    let descu = $( this ).val();
    let precio = $( "#compradetalle-" + row + "-precio_cdetalle").val();
    let cant = $( "#compradetalle-" + row + "-cant_cdetalle").val();
    let total = 0.00;
    let descuento = 0;

    if ( cant ) {

      if ( descu ) {
        total = ( cant * ( precio - ( precio * ( descu / 100 ) ) ) );
        descuento = ( precio * ( descu / 100 ) );
      } else {
        total = cant * precio;
      }

      total = parseFloat(  total  ).toFixed( 2 );
      $( "#compradetalle-" + row + "-total_cdetalle" ).val( total );
      $( "#compradetalle-" + row + "-descu_cdetalle").data( "descuento", descuento);

      calculateTotals( IMPUESTO );
    }
});

function calculateTotals( IMPUESTO ) {
  let total = 0,
      totalImp = 0,
      precioNeto = 0,
      subTotal1 = 0,
      subTotal2 = 0,
      descuento = 0,
      desc = 0;
      subT = 0,
      totals = {
        subtotal1: 0,
        subtotal2: 0,
        descuento: 0,
        impuesto: 0,
        total: 0
      };

  $( "input[id$=\'-total_cdetalle\']" ).each(function (i, element) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    total += parseFloat(element.value);

    if ( $("#compra-excento_compra").prop( "checked" ) ) {
      subT = $( "#compradetalle-" + row + "-precio_cdetalle" ).val()  *  $( "#compradetalle-" + row + "-cant_cdetalle" ).val();
      desc = parseFloat( $( "#compradetalle-" + row + "-descu_cdetalle" ).data( "descuento" ) * $( "#compradetalle-" + row + "-cant_cdetalle" ).val() );
    } else {
      subT = $( "#compradetalle-" + row + "-precio_cdetalle" ).val()  *  $( "#compradetalle-" + row + "-cant_cdetalle" ).val() / ( IMPUESTO + 1 ) ;
      desc = parseFloat( $( "#compradetalle-" + row + "-descu_cdetalle" ).data( "descuento" ) * $( "#compradetalle-" + row + "-cant_cdetalle" ).val()   / ( IMPUESTO + 1 ) );
    }

    subTotal1 += subT;
    descuento += desc;
  });

  descuento = descuento ? descuento : 0;


  precioNeto = total;
  subTotal2 = precioNeto;

  if ( !$("#compra-excento_compra").prop( "checked" ) ) {
    precioNeto = ( total / ( IMPUESTO + 1 ) );
    totalImp = total - precioNeto;
    subTotal2 = precioNeto;
  }

  totals.total = parseFloat(  total  ).toFixed( 2 );
  totals.impuesto = parseFloat( totalImp  ).toFixed( 2 );
  totals.subtotal1 = parseFloat( subTotal1  ).toFixed( 2 );
  totals.subtotal2 = parseFloat( subTotal2  ).toFixed( 2 );
  totals.descuento = parseFloat( descuento  ).toFixed( 2 );

  $( "#subtotal1" ).val( totals.subtotal1 );
  $( "#subtotal2" ).val( totals.subtotal2 );
  $( "#impuesto" ).val( totals.impuesto );
  $( "#total" ).val( totals.total );
  $( "#descuento" ).val( totals.descuento );

  //return totals;
}



';
$this->registerJs($js,View::POS_LOAD);
