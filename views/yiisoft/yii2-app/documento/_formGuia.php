<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Almacen;
use app\models\CondPago;
use app\models\Producto;
use app\models\TipoDocumento;
use app\models\Transportista;
use app\models\UnidadTransporte;
use app\models\TipoMovimiento;
use app\models\MotivoTraslado;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\form\ActiveField;
use yii\web\View ;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use app\base\Model;
use app\controllers\SiteController;

/* @var $this yii\web\View */
/* @var $modelPedido app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
$disabled = false;
$disabledPedido = true;

if ( $model->isNewRecord ) {
  $model->cod_doc = "0000000000";
} else {
  $disabled = true;
}
?>
<div class="row">
  <h2 class="page-header">
      <i class="fa fa-globe"></i> <?= Yii::t('documento','Referral guide') ?>
      <small class="pull-right"><?= Yii::t('app','Date'). ': '.date('d/m/Y')?></small>
  </h2>
</div>
<div class="pedido-form">
      <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true]); ?>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="row"><!--Cliente-->
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <?= Yii::t('cliente','Customer') ?>
                  </h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <?php
                              $url = Url::to(['cliente/cliente-list']);

                              $cliente = "";
                              $clienteText = "";

                              if ( $modelPedido->clte_pedido ) {
                                $cliente = Cliente::findOne($modelPedido->clte_pedido);
                                $clienteText = $cliente->ruc_clte.' - '.$cliente->nombre_clte;
                              }

                              echo $form->field($modelPedido, 'clte_pedido',[
                                'addClass' => 'form-control input-sm',
                                'hintType' => ActiveField::HINT_SPECIAL
                                ])->widget(Select2::classname(), [
                                  'language' => Yii::$app->language,
                                  'size' => Select2::SMALL,
                                  'disabled' => $disabledPedido,
                                  'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
                                  'initValueText' => $clienteText, // set the initial display text
                                  'options' => ['placeholder' => Yii::t('cliente','Select a customer').'...'],
                                  //'theme' => Select2::THEME_DEFAULT,
                                  'pluginOptions' => [
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
                    </div>
                  </div>
                </div>
              </div>
          </div><!-- Cliente -->
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> <!-- Pedido -->
          <div class="row">
            <div class="box box-warning box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">
                  <?= Yii::t('pedido','Order') ?>
                </h3>
              </div>
              <div class="box-body">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <?php
                        $list = ['NP' => 'PEDIDO', 'PR' => 'PROFORMA', 'CT' => 'COTIZACION'];
                      ?>
                      <?= $form->field($modelPedido, 'tipo_pedido',[
                          'addClass' => 'form-control input-sm',
                          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]
                        ])->dropDownList( $list,[
                          'custom' => true,
                          'prompt' => Yii::t('app','Select...'),
                          'disabled' => $disabledPedido,
                        ])?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <?= $form->field($modelPedido, 'cod_pedido',[
                            'addClass' => 'form-control input-sm'
                          ])->textInput([
                            'maxlength' => true,
                            'disabled'=> $disabledPedido,
                            'style' => ['text-align' => 'right']
                            ]) ?>
                    </div>
                  </div>
                  <div class="row">

                  </div>
              </div>
            </div>
          </div>
        </div> <!-- Pedido -->
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"> <!-- Documento -->
          <div class="row">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">
                  <?= Yii::t('documento','Referral guide') ?>
                </h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <?php
                        $tipoDoc = "";
                        $tipoDocText = "";

                        if ( $model->tipo_doc) {
                          $tipoDoc = TipoDocumento::findOne($model->tipo_doc);
                          $tipoDocText = $tipoDoc->des_tipod;
                        }

                        $tiposDoc = TipoDocumento::getTipoDocumento( 'N', TipoDocumento::ES_GUIA );

                        $tipoDocs = [];
                        $dataTipoDocs = [];
                        for ($i = 0; $i < count($tiposDoc); $i++ ){
                          // code...
                          $tipoDocs[$tiposDoc[$i]['id_num']]    = $tiposDoc[$i]['des_tipod'];
                          $dataTipoDocs[$tiposDoc[$i]['id_num']]['id_tipod'] = $tiposDoc[$i]['id_tipod'];
                        }
                        ?>

                        <?= $form->field($model, 'tipo_doc',[
                          'addClass' => 'form-control input-sm',
                          ])->widget(Select2::classname(), [
                                    'data' => $tipoDocs,
                                    'size' => Select2::SMALL,
                                    'initValueText' => $tipoDocText,
                                    'language' => Yii::$app->language,
                                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                                    'options' => [
                                      'placeholder' => Yii::t('tipo_documento','Select a document type').'...',
                                      'data-tipos'  => $dataTipoDocs,
                                    ],
                            ])?>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <?= $form->field($model, 'cod_doc',[
                          'addClass' => 'form-control input-sm',
                          ])->textInput([
                            'readonly' => true,
                            'maxlength' => true,
                            'style' => ['text-align' => 'right']
                          ])?>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <?php
                          $model->fecha_doc = date('d/m/Y');
                          echo $form->field($model, 'fecha_doc',[
                            'addClass' => 'form-control input-sm',
                          ])->textInput([
                                'value' => date('d/m/Y'),
                                'readonly' => 'readonly',
                                'style' => ['text-align' => 'right']
                            ]) ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Documento -->
      </div>

      <div class="row">   <!-- Direccion de partida y envío-->
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <?= Yii::t('documento','Shipment info') ?>
            </h3>
          </div>
          <div class="box-body">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for=""><?= Yii::t('documento','Starting point') ?></label>
                    <?php
                      $empresa = SiteController::getEmpresa();
                    ?>
                    <?= Html::textArea('empresa',$empresa->direcc_empresa,[
                      'id'=>'empresa-direccion_empresa',
                      'class' => 'form-control input-sm',
                      'rows' => 2,
                      'readonly' => $disabledPedido
                    ]); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for=""><?= Yii::t('documento','Arrival point') ?></label>
                    <?= Html::textArea('pedido',$cliente->direcc_clte,[
                      'id'=>'pedido-direccion_pedido',
                      'class' => 'form-control input-sm',
                      'rows' => 2,
                      'readonly' => $disabledPedido
                    ]); ?>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <?php
                  $transportista = "";
                  $transportistaText = "";

                  if ( $model->tipo_doc) {
                    $transportista = Transportista::findOne($model->transp_doc);
                    $transportistaText = $transportista->des_transp;
                  }

                  $transportista = Transportista::getTransportista( );
                  ?>
                  <?= $form->field($model, 'transp_doc',[
                    'addClass' => 'form-control input-sm',
                    ])->widget(Select2::classname(), [
                              'data' => $transportista,
                              'size' => Select2::SMALL,
                              'initValueText' => $transportistaText,
                              'language' => Yii::$app->language,
                              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-globe"></i>']],
                              'options' => [
                                'placeholder' => Yii::t('transportista','Select a carrier').'...',
                              ],
                      ])?>
                      <?php
                      $undTransp = "";
                      $undTranspText = "";

                      if ( $model->utransp_doc) {
                        $undTransp = UnidadTransporte::findOne($model->utransp_doc);
                        $undTranspText = $tipoDoc->des_utransp;
                      }

                      $undTransp = UnidadTransporte::getUnidadTransporte( );
                      ?>
                      <?= $form->field($model, 'utransp_doc',[
                        'addClass' => 'form-control input-sm',
                        ])->widget(Select2::classname(), [
                                  'data' => $undTransp,
                                  'size' => Select2::SMALL,
                                  'initValueText' => $undTranspText,
                                  'language' => Yii::$app->language,
                                  'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-truck"></i>']],
                                  'options' => [
                                    'placeholder' => Yii::t('unidad_transporte','Select a transport unit').'...',
                                  ],
                          ])?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <?php
                    $almacenes = Almacen::getAlmacenList();

                    $model->almacen_doc = $modelPedido->almacen_pedido;
                  ?>
                  <?= $form->field($model, 'almacen_doc',[
                    'addClass' => 'form-control input-sm',
                    ])->widget(Select2::classname(), [
                              'data' => $almacenes,
                              'language' => Yii::$app->language,
                              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-archive"></i>']],
                              'options' => [
                                'placeholder' => Yii::t('almacen','Select a warehouse').'...',
                              ],
                              'size' => Select2::SMALL,
                               'disabled' => true,
                      ])?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label><?= Yii::t('tipo_movimiento','Movement type')?></label>
                  <?php
                    $tipoMovimiento = TipoMovimiento::getTipoMovList(TipoMovimiento::TIPO_SALIDA);

                  ?>
                  <?= Select2::widget([
                        'name' => 'tipo_movimiento',
                        'language' => Yii::$app->language,
                        'data' => $tipoMovimiento,
                        'value' => $model->almacen_doc,
                        //'theme' => Select2::THEME_DEFAULT,
                        'size' => Select2::SMALL,
                        'disabled' => true,
                        'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-archive"></i>']],
                        'options' => [
                            'placeholder' => Yii::t('tipo_movimiento','Select a type'),
                            'options' => [
                                $model::TIPO_FACTURA => ['selected' => true],
                            ]
                        ],
                    ]);?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <?php
                    $motivoTraslado = MotivoTraslado::getMotivos();
                  ?>
                  <?=  $form->field($model, 'motivo_doc',[
                      'addClass' => 'form-control input-sm',
                      ])->widget(Select2::classname(), [
                          'language' => Yii::$app->language,
                          'data' => $motivoTraslado,
                          //'theme' => Select2::THEME_DEFAULT,
                          'size' => Select2::SMALL,
                          //'disabled' => true,
                          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-archive"></i>']],
                          'options' => [
                              'placeholder' => Yii::t('motivo_traslado','Select a reason'),
                              'options' => [
                                $model::MOTIVO_GUIAFACTURA => [ 'selected' => true]
                              ]
                          ],
                    ]);?>
                </div>

              </div>
          </div>
        </div>
      </div>      <!-- Direccion de partida y envío-->

      </div>


      <?php
        $modelsDetalles = $modelPedido->detalles;
      ?>
      <!-- Articulos -->
      <div class="row">
        <div class="container-fluid">
          <?php DynamicFormWidget::begin([
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
                    'id_pdetalle',
                    'prod_pdetalle',
                    'cant_pdetalle',
                    'precio_pdetalle',
                    'descu_pdetalle',
                    'impuesto_pdetalle',
                    'status_pdetalle'
                ],
            ]); ?>

            <div class="row">
                <div class="col-sm-8 col-xs-12"><?= Yii::t( 'pedido', 'Product')?></div>
                <div class="col-sm-4 col-xs-12"><?= Yii::t( 'pedido', 'Qtty')?></div>
            </div>
            <hr>
            <div class="table-body"><!-- widgetContainer -->
            <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
                    <div class="row detalle-item"><!-- widgetBody -->
                      <div class="col-sm-8 col-xs-12">
                      <?php

                      $resultsJs = '
                                  function (data, params) {
                                    params.page = params.page || 1;
                                    return {
                                        results: data.results,
                                        pagination: {
                                            more: (params.page * 30) < data.results.length
                                        }
                                    };
                                  }';

                        // necessary for update action.
                        if (!$modelDetalle->isNewRecord) {
                            echo Html::activeHiddenInput($modelDetalle, "[{$index}]id_pdetalle");
                            //$modelSucursal->empresa_suc[$index] = $model->id_empresa;
                            echo Html::activeHiddenInput($modelDetalle, "[{$index}]pedido_pdetalle");
                        }
                        $url = Url::to(['producto/producto-list']);

                        $producto = [];

                        if ( !empty($modelDetalle->prod_pdetalle) )
                        {
                          $producto = Producto::findOne($modelDetalle->prod_pdetalle);
                        }


                        $productos = empty($modelDetalle->prod_pdetalle) ? '' : $producto->cod_prod.' '.$producto->des_prod.' - '.$producto->umedProd->des_und;
                        echo $form->field($modelDetalle, "[{$index}]prod_pdetalle",[
                          'addClass' => 'form-control ',
                          ])->widget(Select2::classname(), [
                            'language' => Yii::$app->language,
                            'initValueText' => $productos, // set the initial display text
                            'disabled' => $disabledPedido,
                            'options' => [
                                'placeholder' => Yii::t('producto','Select a product').'...',
                                'id' => "some_id{$index}",
                              ],
                            'size' => Select2::SMALL,
                            'pluginOptions' => [
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                    'inputTooShort' => new JsExpression("function() {  return '".Yii::t('app','Please input {number} or more characters', [ 'number'=> 3 ])."';}"),
                                ],
                            'ajax' => [
                                'url' => $url,
                                'dataType' => 'json',
                                'method' => 'POST',
                                'data' => new JsExpression('function(params) { return {desc:params.term,tipo_listap: $("#pedido-tipo_listap").val()}; }'),
                                'processResults' => new JsExpression($resultsJs),
                            ],
                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                            'templateSelection' => new JsExpression( 'function (repo) { return repo.text; }'),
                            'templateResult' => new JsExpression('function (producto) {
                                if (producto.loading) {
                                    return producto.text;
                                }
                               var markup =
                                        "<div class=\\"row\\">" +
                                            "<div class=\\"col-sm-4\\">" +
                                                "<b style=\\"margin-left:5px\\"> " + producto.cod_prod + "</b>" +
                                            "</div>" +
                                            "<div class=\\"col-sm-4\\"><b>U.M.:</b> " + producto.des_und + "</div>" +
                                            "<div class=\\"col-sm-4\\"><b>Stock:</b> " + producto.stock_prod + "</div>" +
                                        "</div>";

                                if (producto.des_prod) {
                                  markup += "<p>" + producto.des_prod + "</p>";
                                }

                                return "<div style=\\"overflow:hidden;\\">" + markup + "</div>";

                            }'),
                            ],
                        ])->label(false);

                        echo Html::activeHiddenInput($modelDetalle, "[{$index}]prod_pdetalle");
                        ?>

                      </div>
                      <div class="col-sm-4 col-xs-12">
                        <?= $form
                        ->field($modelDetalle,"[{$index}]cant_pdetalle",[ 'addClass' => 'form-control input-sm number-integer'])
                        ->textInput(['type' => 'text', 'readonly' => $disabledPedido])
                        ->label(false)?>
                      </div>
                  </div>
            <?php endforeach; ?>
          </div>

          <?php DynamicFormWidget::end(); ?>
          <hr>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <?= $form->field($model, 'obsv_doc')->textarea(['rows' => 3, 'disabled' => $disabled])?>
            </div>
          </div>
        </div>
      </div>
      <!-- Articulos -->

      <?php
        $model->pedido_doc = $modelPedido->id_pedido;
        echo Html::activeHiddenInput($model, "pedido_doc");
      ?>


      <?php ActiveForm::end(); ?>
</div>

<?php

$css = "
.input-group.select2-bootstrap-prepend .select2-container--krajee .select2-selection {
    border-radius: 0;
}

.input-sm.select2-container--krajee .select2-selection--single, .input-group-sm .select2-container--krajee .select2-selection--single{
  border-radius: 0;
}
";

Yii::$app->view->registerCss($css);

$this->registerJsVar( "buttonPrint", "#imprimir" );
Yii::$app->view->registerJs('const IMPUESTO = '. $IMPUESTO .' / 100;',  \yii\web\View::POS_HEAD);
$js = '
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
  $( frameRpt ).attr( "src", "'.Url::to(['documento/pedido-rpt', 'id' => $model->id_doc]).'");
  $( modalRpt ).modal({
    backdrop: "static",
    keyboard: false,
  });
  $( modalRpt ).modal("show");
});


$( "#documento-tipo_doc" ).on( "select2:select",function () {
  $.ajax({
    url     : "'.Url::to(['numeracion/ajax-get-numeracion']).'",
    data    : { id: this.value },
    success : function ( data ) {
      num = +data["numero_num"] + 1;
      num = "0"+num;
      $( "#documento-cod_doc" ).val( num.padStart(10,"0")  );
    }
  })

});

$("#pedido_tipo  input[type=\'radio\']").iCheck({
  checkboxClass: "icheckbox_flat-green",
  radioClass   : "iradio_flat-green"
});

$( ".table-body" ).on("select2:select","select[id$=\'prod_pdetalle\']",function() {
	let _currSelect = $( this );
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  let selects = $("select[id$=\'prod_pdetalle\']");

  if ( checkDuplicate( _currSelect, row, selects) ) {
    _currSelect.val( null ).trigger( "change" );
    swal( "Oops!!!","El código no puede repetirse, ya está en la lista","error" );
    _currSelect.focus();
  }

  let valor = parseInt( _currSelect.val() );
  let tipoLista = parseInt( $( "#pedido-tipo_listap" ).val() );

  if ( valor ) {
    setPrices( valor, row, tipoLista);
    $( "#pedidodetalle-" + row + "-cant_pdetalle" ).focus();
  }

});

$( ".table-body" ).on( "change", "input[id$=\'cant_pdetalle\']", function( e ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    let cant = $( this ).val();
    let precio = $( "#pedidodetalle-" + row + "-plista_pdetalle").val();
    let descu = $( "#pedidodetalle-" + row + "-descu_pdetalle").val();
    let total = 0.00;

    if ( cant ) {

      if ( descu ) {
        total = ( cant * ( precio - (precio * ( descu / 100 ) ) ) );
      } else {
        total = cant * precio;
      }

      total = parseFloat(  total  ).toFixed( 2 );
      $( "#pedidodetalle-" + row + "-total_pdetalle" ).val( total );

      calculateTotals( IMPUESTO );
    }
});

$( ".table-body" ).on( "change", "input[id$=\'descu_pdetalle\']", function( e ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    let descu = $( this ).val();
    let precio = $( "#pedidodetalle-" + row + "-plista_pdetalle").val();
    let cant = $( "#pedidodetalle-" + row + "-cant_pdetalle").val();
    let total = 0.00;
    let descuento = 0;
    let precioVenta = 0.00;

    if ( cant ) {

      if ( descu ) {
        total = ( cant * ( precio - ( precio * ( descu / 100 ) ) ) );
        precioVenta = precio - ( precio * ( descu / 100 ) );
        descuento = ( precio * ( descu / 100 ) );
      } else {
        total = cant * precio;
      }

      descuento = parseFloat( descuento ).toFixed( 2 );
      precioVenta = parseFloat(  precioVenta  ).toFixed( 2 );
      total = parseFloat(  total  ).toFixed( 2 );

      $( "#pedidodetalle-" + row + "-descu_pdetalle").data( "descuento", descuento);
      $( "#pedidodetalle-" + row + "-precio_pdetalle" ).val( precioVenta );
      $( "#pedidodetalle-" + row + "-total_pdetalle" ).val( total );

      calculateTotals( IMPUESTO );
    }
});

$( ".table-body" ).on( "change", "input[id$=\'precio_pdetalle\']", function( e ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    let cant = $( "#pedidodetalle-" + row + "-cant_pdetalle").val();
    let precio = $( this ).val();
    let total = 0;

    if ( cant ) {
      total = cant * precio;
      total = parseFloat(  total  ).toFixed( 2 );
      $( "#pedidodetalle-" + row + "-total_pdetalle" ).val( total );

      calculateTotals( IMPUESTO );
    }

});

$( ".table-body" ).on( "blur", "input[id$=\'precio_pdetalle\']", function( e ) {
  calculateTotals( IMPUESTO );
});

$( ".table-body" ).on( "keyup", "input[id$=\'cant_pdetalle\']", function( e ) {

  if ( e.keyCode === 13 && $( this ).val() ) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    $( "#pedidodetalle-" + row + "-descu_pdetalle" ).focus();
    $( "#pedidodetalle-" + row + "-descu_pdetalle" ).select();
  }

});

$( ".table-body" ).on( "keyup", "input[id$=\'descu_pdetalle\']", function( e ){
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  if ( e.keyCode === 13 && $( "#pedidodetalle-" + row + "-cant_pdetalle" ).val() ) {
    $( "#pedidodetalle-" + row + "-precio_pdetalle" ).focus();
  }
});

$( ".table-body" ).on( "keyup", "input[id$=\'precio_pdetalle\']", function( e ) {
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  if ( e.keyCode === 13 && $( this ).val() &&
       $( "#pedidodetalle-" + row + "-prod_pdetalle").val()  )  {

      swal({
        title: "¿Deseas agregar un  nuevo item?",
        icon: "info",
        buttons: true,
      }).then( ( willDelete ) => {
        if ( willDelete ) {
          let row = $( ".detalle-item" ).length;
          $( ".add-item" ).trigger( "click" );
          $( "#pedidodetalle-" + row + "-prod_pdetalle").focus();
          $( "#pedidodetalle-" + row + "-prod_pdetalle").select2("open");
        }
      });
  }
});

$( "body" ).on( "click", buttonCancel, function(){
  $( frameRpt ).attr( "src", "about:blank" );
  $( modalRpt ).modal("hide");
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

  $( "input[id$=\'-total_pdetalle\']" ).each(function (i, element) {
    let row = $( this ).attr( "id" ).split( "-" );
    row = row[ 1 ];
    total += parseFloat(element.value);
    subT = $( "#pedidodetalle-" + row + "-plista_pdetalle" ).val()  *  $( "#pedidodetalle-" + row + "-cant_pdetalle" ).val() / ( IMPUESTO + 1 ) ;
    desc = parseFloat( $( "#pedidodetalle-" + row + "-descu_pdetalle" ).data( "descuento" ) * $( "#pedidodetalle-" + row + "-cant_pdetalle" ).val()   / ( IMPUESTO + 1 ) );
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

  //return totals;
}

$("#pedido-clte_pedido").trigger("select2:select");
$("select[id$=\'prod_pdetalle\']").trigger("change");

$("select[id$=\'prod_pdetalle\']").each(function( i ){

  let row = $( this ).attr( \'id\' ).split( \'-\' );
  row = row[ 1 ];

  setPrices( $( this ).val(), row,   $( "#pedido-tipo_listap" ).val() );
  $("#pedidodetalle-" + row + "-descu_pdetalle").trigger( "change" );
  $("#pedidodetalle-" + row + "-precio_pdetalle").trigger( "blur" );
});

function setPrices( value = null, row, tipo_lista ) {
  if ( value ) {
    $.ajax({
        url:"'.Url::to(['producto/product-price']).'",
        data:{
          id: value,
          tipo_listap: tipo_lista
        },
        success: function( data ) {
          if ( data.results ) {
            let precioLista = data.results[ 0 ].precio;
            let impuestoDetalle = data.results[ 0 ].precio - data.results[ 0 ].precio / ( IMPUESTO + 1 );

            precioLista = parseFloat(  precioLista  ).toFixed( 2 );
            impuestoDetalle = parseFloat(  impuestoDetalle  ).toFixed( 2 );

            $( "#pedidodetalle-" + row + "-plista_pdetalle" ).val( precioLista );
            $( "#pedidodetalle-" + row + "-impuesto_pdetalle" ).val( impuestoDetalle );

            let descuDetalle = $( "#pedidodetalle-" + row + "-descu_pdetalle" ).val( );
            descuDetalle = descuDetalle ? descuDetalle : 0;

            $( "#pedidodetalle-" + row + "-descu_pdetalle" ).val( descuDetalle );
            $( "#pedidodetalle-" + row + "-precio_pdetalle" ).val( precioLista );
          }
        }
    });
  }
}

$( "#submit" ).on( "click", function() {
  let form = $( "form#'. $model->formName() .'" );

  let rows = $(".table-body > .detalle-item").length;

  if ( !rows ) {
    swal("'.Yii::t('pedido','Order').'", "'.Yii::t('pedido','The order must have at least one item to be saved').'", "info");
    return false;
  }

  $.ajax( {
    "url"    : $( form ).attr( "action" ),
    "method" : $( form ).attr( "method" ),
    "data"   : $( form ).serialize(),
    "async"  : false,
    "success": function ( data ) {
      if ( data.success ) {


        if ( $( form ).attr("action").indexOf("create") != -1) {
          $( form ).trigger( "reset" );
          selects = $(form).find("select");

          if ( selects.length ){
            selects.trigger( "change" );
          }

          swal({
            title: "'.Yii::t('pedido','Do you want to issue the document?').'",
            icon: "info",
            buttons: true,
            dangerMode: true,
          })
          .then((willIssue) => {
            if (willIssue) {
              window.open("'.Url::to(['pedido/pedido-rpt']).'&id=" + data.id,
              "'. Yii::t('documento','Referral guide').'",
              "toolbar=no," +
              "location=no," +
              "statusbar=no," +
              "menubar=no," +
              "resizable=0," +
              "width=800," +
              "height=600," +
              "left = 490," +
              "top=300");
            }
          });

          $( ".table-body" ).empty();
        }

        if ( data.codigo ) {
          $( "#pedido-cod_pedido" ).val( data.codigo );
        }

        swal(data.title, data.message, data.type);

        return;
      } else {
        $( form ).yiiActiveForm( "updateMessages", data);
      }

    },
    error: function(data) {
        let message;

        if ( data.responseJSON ) {
          let error = data.responseJSON;
          message =   "Se ha encontrado un error: " +
          "\\n\\nCode " + error.code +
          "\\n\\nFile: " + error.file +
          "\\n\\nLine: " + error.line +
          "\\n\\nName: " + error.name +
          "\\n Message: " + error.message;
        } else {
            message = data.responseText;
        }

        swal("Oops!!!",message,"error" );
    }
  });


});
';

Yii::$app->view->registerJs($js,View::POS_END);


Yii::$app->view->registerJsFile(Yii::$app->getUrlManager()->getBaseUrl().'/js/dynamicform.js',
['depends'=>[\yii\web\JqueryAsset::className()],
'position'=>View::POS_END]);

$this->registerJsVar( "buttonPrint", "#imprimir" );
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);
