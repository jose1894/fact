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
use kartik\select2\Select2;
use app\base\Model;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
$disabled = false;

if ( $model->isNewRecord ) {
  $model->cod_pedido = "0000000000";
  $model->fecha_pedido = date('d/m/Y');
} else {
  $model->fecha_pedido = date('d/m/Y',strtotime($model->fecha_pedido));
  $disabled = true;
}
?>

<div class="pedido-form">

  <div class="container-fluid">

      <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true]); ?>
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <?= $form
          ->field($model, 'cod_pedido',['addClass' => 'form-control '])
          ->textInput(['maxlength' => true,'readonly' => true, 'style' => ['text-align' => 'right']]) ?>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <?php
            echo $form->field($model, 'fecha_pedido',[
              'addClass' => 'form-control ',
            ])->textInput([
                  'value' => $model->fecha_pedido,
                  'readonly' => 'readonly',
                  'style' => ['text-align' => 'right'],
                  'disabled' => $disabled,
              ]) ?>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <?php
          $url = Url::to(['cliente/cliente-list']);
          $cliente = empty($model->clte_pedido) ? '' : Cliente::findOne($model->clte_pedido)->nombre_clte;
          echo $form->field($model, 'clte_pedido',[
            'addClass' => 'form-control ',
            'hintType' => ActiveField::HINT_SPECIAL
            ])->widget(Select2::classname(), [
              'language' => Yii::$app->language,
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
              'initValueText' => $cliente, // set the initial display text
              'options' => ['placeholder' => Yii::t('cliente','Select a customer').'...'],
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
              'templateResult' => new JsExpression('function(cliente) { return cliente.text; }'),
              'templateSelection' => new JsExpression('function (cliente) {
                  return cliente.text;
                }'),
              ],
          ])
          ?>

          <?=  Html::hiddenInput("pedido-tipo_listap", " ",['id'=>'pedido-tipo_listap']); ?>
        </div>

      </div>
      <div class="row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
          <label for=""><?= Yii::t('cliente','Address') ?></label>
          <?= Html::textArea('pedido',"",[
            'id'=>'pedido-direccion_pedido',
            'class' => 'form-control ',
            'rows' => 1,
            'readonly' => true
          ]); ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
          <?php
            $list = ['NP' => 'PEDIDO', 'PR' => 'PROFORMA', 'CT' => 'COTIZACION'];
          ?>
          <?= $form->field($model, 'tipo_pedido',[
              'addClass' => 'form-control ',
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]
            ])->dropDownList( $list,
              ['custom' => true, 'prompt' => Yii::t('app','Select...'), 'disabled' => $disabled,]
              ) ?>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?php
          $vendedor = empty($model->vend_pedido) ? '' : Vendedor::findOne($model->vend_pedido)->nombre_vend;
          $vendedores = Vendedor::getVendedoresList();
          ?>
          <?= $form->field($model, 'vend_pedido',[
            'addClass' => 'form-control ',
            ])->widget(Select2::classname(), [
                      'data' => $vendedores,
                      'initValueText' => $vendedor,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
                      'options' => [
                        'placeholder' => Yii::t('vendedor','Select a seller').'...',
                      ],
                      'theme' => Select2::THEME_DEFAULT,
              ])?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?php
            $monedas = Moneda::getMonedasList();
          ?>
          <?= $form->field($model, 'moneda_pedido',[
          'addClass' => 'form-control ',
            ])->widget(Select2::classname(), [
                      'data' => $monedas,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-money"></i>']],
                      'options' => ['placeholder' => Yii::t('moneda','Select a currency').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      'disabled' => $disabled
              ])?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?= $form->field($model, 'nrodoc_pedido',['addClass' => 'form-control '])->textInput(['maxlength' => true]) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php
            $almacenes = Almacen::getAlmacenList();
          ?>
          <?= $form->field($model, 'almacen_pedido',[
            'addClass' => 'form-control ',
            ])->widget(Select2::classname(), [
                      'data' => $almacenes,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-archive"></i>']],
                      'options' => ['placeholder' => Yii::t('almacen','Select a warehouse').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      'disabled' => $disabled,
                      // 'pluginOptions' => [
                      //     'allowClear' => true
                      // ],
              ])?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php
          $condiciones = CondPago::getCondPagoList();
          ?>
          <?= $form->field($model, 'condp_pedido',[
              'addClass' => 'form-control',
            ])->widget(Select2::classname(), [
                      'data' => $condiciones,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']],
                      'options' => ['placeholder' => Yii::t('condicionp','Select a payment condition').'...'],
                      'theme' => Select2::THEME_DEFAULT,
              ])?>
              <?php
                echo Html::activeHiddenInput($model, "usuario_pedido");
              ?>
        </div>
      </div>

      <!-- Articulos -->
      <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1 col-xs-12">#</div>
                <div class="col-sm-5 col-xs-12"><?= Yii::t( 'pedido', 'Product')?></div>
                <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Qtty')?></div>
                <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'L. price')?></div>
                <!--th class="col-xs-1"><?= Yii::t( 'pedido', 'Tax')?></th-->
                <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Disc.')?></div>
                <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Price')?></div>
                <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Total')?></div>
                <div class="col-sm-1 col-xs-12">
                  <button type="button" class="add-item btn btn-success btn-flat btn-md" style="width:100%"  data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Add item')?>"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <hr>
            <div class="table-body"><!-- widgetContainer -->
              <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
                      <div class="row detalle-item"><!-- widgetBody -->
                        <div class="col-sm-1 col-xs-12 nro">
                          <?= ( $index + 1 )?>
                        </div>
                        <div class="col-sm-5 col-xs-12">
                        <?= $modelDetalle->productoPdetalle->des_prod ?>
                        </div>
                        <div class="col-sm-1 col-xs-12 cantidad">
                          <?= $modelDetalle->cant_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12 plista">
                          <?= $modelDetalle->plista_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12 descuento">
                          <?= $modelDetalle->descu_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12 precio">
                          <?= $modelDetalle->precio_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12 total text-right">
                          <?= $modelDetalle->total_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                          <button type="button" class="remove-item btn btn-danger btn-flat btn-md" style="width:100%" data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Delete item')?>"><i class="fa fa-trash"></i></button>
                      </div>
                    </div>
              <?php endforeach; ?>
            </div>
          <div class="row">
                <div class="col-sm-11 col-xs-12"></div>
                <div class="col-sm-1 col-xs-12">
                  <!-- <button type="button" class="add-item btn btn-success btn-flat btn-md" style="width:100%"  data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Add item')?>"><i class="fa fa-plus"></i></button> -->
                </div>
          </div>
          <hr>
          <table class="table table-fixed table-stripped">
            <!--tr>
              <td class="col-xs-6" style="text-align:right;">
                <?= Yii::t('app', 'Subtotal') ?>
              </td>
              <td class="col-xs-2">
                <input type="text" id="subtotal1" name="subtotal" readonly class="form-control totales" value="">
              </td>
            </tr-->
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

       <div class="form-group" style="float:right">
        <?php if ( !$model->isNewRecord ) { ?>
           <button type="button" name="button" id="imprimir" data-toggle="modal" class="btn btn-flat btn-primary "><span class="fa fa-print"></span> <?= Yii::t('app', 'Print')?></button>
        <?php } ?>
           <button id="submit" type="button" class="btn btn-flat btn-success"><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
       </div>
      <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- Modal-->
  <div class="modal fade modal-wide" id="modal-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-dismiss="true" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
          </button>
          <h4 class="modal-title" id="modal-prod-title"><?= Yii::t('producto', 'Product')?></h4>
        </div>
        <div class="modal-body">
          <div class="row" style="padding:15px">
            <div class="col-lg-5 col-md-5 col-sm-1">
              <label for="select-producto"><?= Yii::t('producto', 'Product')?></label>
              <?= Select2::widget( [
                    'name' => 'select-product',
                    'data' => Producto::getProductoList(),
                    'initValueText' => null,
                    'language' => Yii::$app->language,
                    'options' => [
                    				'allowClear' => true,
                    				'placeholder' => Yii::t('producto','Select a product').'...',
                            'id' => 'select-producto'
                    ],
              			'changeOnReset' => true,
                    'theme' => Select2::THEME_DEFAULT,
            ]) ?>
            <input type="hidden" name="id_prod" value="">
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1">
            <label for="stock"><?= Yii::t('producto', 'Stock')?></label>
            <?= Html::input('number','stock','', $options=['class'=>'form-control number-integer', 'id' => 'stock', 'maxlength'=>5, 'readonly' => true, 'pattern' => '[0-9]*\.?[0-9]*']) ?>
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1">
            <label for="cantidad"><?= Yii::t('producto', 'Quantity')?></label>
            <?= Html::input('number','cantidad','', $options=['class'=>'form-control number-integer', 'id' => 'cantidad', 'maxlength'=>5, 'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1">
            <label for="plista"><?= Yii::t('producto', 'P.Lista')?></label>
            <?= Html::input('number','plista','', $options=['class'=>'form-control number-integer', 'id' => 'plista', 'readonly' => true, 'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1">
            <label for="descuento"><?= Yii::t('producto', 'Discount')?></label>
            <?= Html::input('number','descuento','', $options=['class'=>'form-control number-decimals', 'id' => 'descuento',  'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1">
            <label for="precio"><?= Yii::t('producto', 'Price')?></label>
            <?= Html::input('number','precio','', $options=['class'=>'form-control number-decimals', 'id' => 'precio',  'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-1">
            <label for="total"><?= Yii::t('producto', 'Total')?></label>
            <?= Html::input('number','total','', $options=['class'=>'form-control number-integer', 'id' => 'total',  'readonly' => true,'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
          </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->

<?php
$this->registerJsVar( "buttonPrint", "#imprimir" );
Yii::$app->view->registerJs('const IMPUESTO = '. $IMPUESTO .' / 100;',  \yii\web\View::POS_HEAD);
$this->registerJs("
const URI_PPRICE = '".Url::to(['producto/product-price'])."';
const URI_PRINT = '".Url::to(['pedido/pedido-rpt', 'id' => $model->id_pedido])."';
const URI_CLIENTE = '". Url::to(['cliente/cliente-list'])."';
", \yii\web\View::POS_HEAD);

$jsTrigger = "";

if ( !$model->isNewRecord ){
  $jsTrigger = "
    console.log('trigger');
    $('#pedido-clte_pedido').trigger('change');
  ";
}
$this->registerJs($jsTrigger,View::POS_LOAD);

$js = <<< JS
$( 'body' ).on('click', '.add-item', function () {
  $( '#modal-producto' ).modal( {backdrop: 'static', keyboard: false} )
});

$( buttonPrint ).on( "click", function(){
  $( frameRpt ).attr( "src", URI_PRINT );
  $( modalRpt ).modal({
    backdrop: "static",
    keyboard: false,
  });
  $( modalRpt ).modal("show");
});

$( "#pedido-clte_pedido" ).on( "change",function () {

  $.ajax({
    url: URI_CLIENTE,
    method: "GET",
    data: { id : $(this).val()},
    async: false,
    success: function( cliente ) {
      console.log("cliente");
      cliente = cliente[ 0 ];
      let direccion = cliente ? cliente.direcc_clte : " ",
          geo = cliente ? cliente.geo : " ",
          //textDirecc = direccion + " " + geo,
          textDirecc = direccion,
          condp = cliente ? cliente.condp : " ",
          vendedor = cliente ? cliente.vendedor : " ",
          tpl = cliente ? cliente.tpl : " ";

      $( "#pedido-direccion_pedido" ).val( textDirecc );

	  //$( "#pedido-condp_pedido" ).val( 10 ).trigger( "select2:select" );

      if ( !$( "#pedido-condp_pedido" ).val() ) {
        $( "#pedido-condp_pedido" ).val( condp ).trigger( "change" );
      }

      $( "#pedido-vend_pedido" ).val( vendedor );
      $( "#pedido-tipo_listap" ).val( tpl );
      //$( "#pedido-condp_pedido" ).trigger( "select2:select" );
      $( "#pedido-vend_pedido" ).trigger( "change" );

    }
  });

});

$( '#cantidad' ).on('keyup', function (ev) {
  if ( +$('#select-producto').val() ) {
    let cant = +$(this).val();

    if ( cant ) {
      let desc = $('#descuento').val();
      let precioLista = $('#plista').val()
      calculateProduct(cant, desc, precioLista);
    }
  }
})

function calculateProduct( cant = 0, desc = 0, precioLista = 0) {

  let total = 0;

  total = cant * precioLista;

  return total;
}


$( '#select-producto').on('select2:select', function(){
  // let _currSelect = $( this );
  // let row = $( this ).attr( "id" ).split( "-" );
  // row = row[ 1 ];
  //
  // let selects = $("select[id$='prod_pdetalle']");
  //
  // if ( checkDuplicate( _currSelect, row, selects) ) {
  //   _currSelect.val( null ).trigger( 'change' );
  //   swal( 'Oops!!!',"El código no puede repetirse, ya está en la lista","error" );
  //   _currSelect.focus();
  // }
  //
  // let valor = parseInt( _currSelect.val() );
  const tipoLista = +$( "#pedido-tipo_listap" ).val();

  const valor = $(this).val();

  if ( valor ) {
    $( "#cantidad" ).focus();
    $( "#cantidad" ).val("");
    $( "#descuento" ).val("");
    $( "#precio" ).val("");
    $( "#total" ).val("");
    setPrices( valor, tipoLista);
  }
});

function setPrices( value = null, tipo_lista, sync = false ) {
  if ( value && tipo_lista ) {
    $.ajax({
        url: URI_PPRICE,
        data:{
          id: value,
          tipo_listap: tipo_lista
        },
        async: sync,
        success: function( data ) {
          if ( data.results.length ) {
            let precioLista = +data.results[ 0 ].precio;
            let impuestoDetalle = +data.results[ 0 ].precio - +data.results[ 0 ].precio / ( IMPUESTO + 1 );

            precioLista = parseFloat(  precioLista  ).toFixed( 2 );
            impuestoDetalle = parseFloat(  impuestoDetalle  ).toFixed( 2 );

            $( '#stock' ).val( +data.results[ 0 ].stock);

            $( '#plista' ).val( precioLista );
            $( '#impuesto' ).val( impuestoDetalle );

            let descuDetalle = $( '#descuento' ).val( );
            descuDetalle = descuDetalle ? descuDetalle : 0;

            // $( '#pedidodetalle-' + row + '-descu_pdetalle' ).val( descuDetalle );
            $( '#precio' ).val( descuDetalle );
            //$( '#pedidodetalle-' + row + '-precio_pdetalle' ).val( precioLista );
          }
        }
    });
  }
}

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

  $( '.detalle-item' ).each(function (i, element) {
    let row = "." + element.classList.value.split(' ').join('.');
    total += +$( row + ' .total' )[i].textContent;
    subT = $( row + ' .plista' )[i].textContent  *  $( row + ' .cantidad' )[i].textContent / ( IMPUESTO + 1 ) ;
    desc = parseFloat( $( row + ' .descuento' ).data( "descuento" ) * $( row + ' .cantidad' ).val()   / ( IMPUESTO + 1 ) );
    subTotal1 += subT;
    descuento += desc;
  });

  descuento = descuento ? descuento : 0;

  precioNeto = ( total / ( IMPUESTO + 1 ) );
  totalImp = total - precioNeto;
  subTotal2 = precioNeto;

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

  return totals;
}
JS;

$this->registerJs($js,View::POS_END);
