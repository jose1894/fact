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
use app\components\AutoIncrement;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
if ( $model->isNewRecord ) {
  $model->cod_pedido = AutoIncrement::getAutoIncrementPad( 'pedido' );
}
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'cod_pedido',['addClass' => 'form-control '])->textInput(['maxlength' => true,'readonly' => true]) ?>
      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?php
          $model->fecha_pedido = date('d/m/Y');
          echo $form->field($model, 'fecha_pedido',[
            'addClass' => 'form-control ',
          ])->widget(DatePicker::classname(),[
                'value' => date('d/m/Y'),
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'format' => 'dd/mm/yyyy',
                    'autoclose' => true,
                ]
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
                'allowClear' => true,
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
                let direccion = cliente.direcc_clte ? cliente.direcc_clte : " ",
                    geo = cliente.geo ? cliente.geo : " ",
                    textDirecc = direccion + " " + geo,
                    condp = cliente.condp,
                    vendedor = cliente.vendedor,
                    tpl = cliente.tpl;

                $( "#pedido-direccion_pedido" ).val( textDirecc );
                $( "#pedido-condp_pedido" ).val( condp );
                $( "#pedido-condp_pedido" ).trigger( "change" );
                $( "#pedido-vend_pedido" ).val( vendedor );
                $( "#pedido-vend_pedido" ).trigger( "change" );
                $( "#pedido-tipo_listap" ).val( tpl );

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
          $list = [0 => 'PEDIDO', 1 => 'PROFORMA', 2 => 'COTIZACION'];
          $model->tipo_pedido = 0;
        ?>
        <?= $form->field($model, 'tipo_pedido')->radioList($list, ['custom' => true,'id'=>'pedido_tipo','inline'=>true, ]) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?php $vendedores = Vendedor::find()->where(['estatus_vend' => 1])
        ->orderBy('nombre_vend')
        ->all();
        $vendedores = ArrayHelper::map($vendedores,'id_vendedor','nombre_vend');
        ?>
        <?= $form->field($model, 'vend_pedido',[
          'addClass' => 'form-control ',
          ])->widget(Select2::classname(), [
                    'data' => $vendedores,

                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
                    'options' => ['placeholder' => Yii::t('vendedor','Select a seller').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ])?>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?php $monedas = Moneda::find()->where(['status_moneda' => 1])
        ->orderBy('des_moneda')
        ->all();
        $monedas = ArrayHelper::map( $monedas, 'id_moneda', 'des_moneda');
        ?>
        <?= $form->field($model, 'moneda_pedido',[
        'addClass' => 'form-control ',
          ])->widget(Select2::classname(), [
                    'data' => $monedas,
                    'language' => Yii::$app->language,

                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-money"></i>']],
                    'options' => ['placeholder' => Yii::t('moneda','Select a currency').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ])?>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'nrodoc_pedido',['addClass' => 'form-control '])->textInput(['maxlength' => true]) ?>
      </div>

    </div>


    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php $almacenes = Almacen::find()->where(['status_almacen' => 1])
        ->orderBy('des_almacen')
        ->all();
        $almacenes = ArrayHelper::map( $almacenes, 'id_almacen', 'des_almacen');
        ?>
        <?= $form->field($model, 'almacen_pedido',[
          'addClass' => 'form-control ',
          ])->widget(Select2::classname(), [
                    'data' => $almacenes,
                    'language' => Yii::$app->language,

                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-archive"></i>']],
                    'options' => ['placeholder' => Yii::t('almacen','Select a warehouse').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ])?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php $condiciones = CondPago::find()->where(['status_condp' => 1])
        ->orderBy('desc_condp')
        ->all();
        $condiciones = ArrayHelper::map( $condiciones, 'id_condp', 'desc_condp');
        ?>
        <?= $form->field($model, 'condp_pedido',[
            'addClass' => 'form-control',
          ])->widget(Select2::classname(), [
                    'data' => $condiciones,

                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']],
                    'options' => ['placeholder' => Yii::t('condicionp','Select a payment condition').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
            ])?>
      </div>
    </div>

    <!-- Articulos -->
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

          <table cellspacing="0" cellpadding="0" border="0" style="width:100%">
            <tr>
              <td>
                <table id="table" class="table table-fixed table-stripped" style="width:98%" >
                  <thead>
                    <tr>
                      <th class="col-xs-5">Producto</th>
                      <th class="col-xs-1">Cantidad</th>
                      <th class="col-xs-1">Precio</th>
                      <th class="col-xs-1">Descuento</th>
                      <th class="col-xs-1">Precio venta</th>
                      <th class="col-xs-1">Total</th>
                      <th class="col-xs-1">Status</th>
                      <th  class="col-xs-1">
                        <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                        <div class="clearfix"></div>
                      </th>
                    </tr>
                  </thead>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <div style="width:99.4%; height:300px; overflow-y:scroll;">
                  <table id="table" class="table table-fixed table-stripped" >
                    <tbody class="table-body"><!-- widgetContainer -->
                      <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
                              <tr class="detalle-item"><!-- widgetBody -->
                                <?php
                                  // necessary for update action.
                                  if (!$modelDetalle->isNewRecord) {
                                      echo Html::activeHiddenInput($modelDetalle, "[{$index}]id_pdetalle");
                                      //$modelSucursal->empresa_suc[$index] = $model->id_empresa;
                                      echo Html::activeHiddenInput($modelDetalle, "[{$index}]pedido_pdetalle");
                                  }
                                ?>
                                <td class="col-xs-5">
                                  <?php
                                  $url = Url::to(['producto/producto-list']);

                                  $productos = empty($modelDetalle->prod_des) ? '' : Producto::findOne($modelDetalle->prod_pdetalle)->prod_des;

                                  echo $form->field($modelDetalle, "[{$index}]prod_pdetalle",[
                                    'addClass' => 'form-control ',
                                    ])->widget(Select2::classname(), [
                                      'language' => Yii::$app->language,
                                      'initValueText' => $productos, // set the initial display text

                                      'options' => ['placeholder' => Yii::t('producto','Select a product').'...'],
                                      'theme' => Select2::THEME_DEFAULT,
                                      'pluginOptions' => [
                                          'allowClear' => true,
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
                                      'templateResult' => new JsExpression('function(cliente) { return cliente.text; }'),
                                      'templateSelection' => new JsExpression('function (cliente) {
                                          return cliente.text;
                                        }'),
                                      ],
                                  ])->label(false);
                                  ?>

                                </td>
                                <td class="col-xs-1">
                                  <?= $form->field($modelDetalle,"[{$index}]cant_pdetalle")->textInput([ 'class' => 'form-control ','type' => 'number','maxlength' => true,'style' => ['text-align' => 'right']])->label(false)?>
                                </td>
                                <td class="col-xs-1">
                                  <?= Html::input("text","yy","0.00",['class' => 'form-control ','id'=> 'pedidodetalle-'.$index.'-precio_lista','style'=>[ 'text-align'=>'right'],'readonly' => true]) ?>
                                </td>
                                <td class="col-xs-1">
                                  <?= $form->field($modelDetalle,"[{$index}]descu_pdetalle")->textInput(['class' => 'form-control ','type'=>'number','maxlength' => true,'width' => '200px'])->label(false)?>
                                </td>
                                <td class="col-xs-1">
                                  <?= $form->field($modelDetalle,"[{$index}]precio_pdetalle")->textInput(['class' => 'form-control ','type'=>'number','maxlength' => true,'width' => '200px'])->label(false)?>
                                </td>
                                <td class="col-xs-1">
                                  <?= Html::input("text","yy","0.00",['class' => 'form-control ','id'=> 'pedidodetalle-'.$index.'-total','style'=>[ 'text-align'=>'right'],'readonly' => true]) ?>
                                </td>
                                <td class="col-xs-1">

                                </td>
                                <td class="col-xs-1">
                                  <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                  <div class="clearfix"></div>
                              </td>
                              </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
              </div>
          <?php DynamicFormWidget::end(); ?>
          </td>
        </tr>
        <tr>
          <td>
            <div class="">
              <table class="table table-fixed table-stripped">
                <tr>
                  <td class="col-xs-6" style="text-align:right;">
                    Subtotal
                  </td>
                  <td class="col-xs-2">
                    <input type="text" name="subtotal" class="form-control" value="">
                  </td>
                </tr>
                <tr>
                  <td class="col-xs-6" style="text-align:right;">
                    Descuento
                  </td>
                  <td class="col-xs-2">
                    <input type="text" name="descuento" class="form-control" value="">
                  </td>
                </tr>
                <tr>
                  <td class="col-xs-7" style="text-align:right;">
                    I.G.V.
                  </td>
                  <td class="col-xs-2">
                    <input type="text" name="impuesto" class="form-control" value="">
                  </td>
                </tr>
                <tr>
                  <td class="col-xs-6" style="text-align:right;">
                    Total
                  </td>
                  <td class="col-xs-2">
                    <input type="text" name="total" class="form-control" value="">
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
      </div>
    </div>
    <!-- Articulos -->


    <?php
    /*
    * Campos ocultos pero necesarios
    */
    // Campo de usuario
    $model->usuario_pedido = Yii::$app->user->id;


    //$form->field($model, 'usuario_pedido')->textInput()

    //$form->field($model, 'estatus_pedido')->textInput()

    //$form->field($model, 'sucursal_pedido')->textInput() */
     ?>
    <?php ActiveForm::end(); ?>

</div>

<?php

$js = '
$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
  if ( confirm("'.Yii::t('producto','Are you sure to delete this product?').'") ){
    return true;
  }

  return false;

});


$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
';

$this->registerJs($js,View::POS_LOAD);


$this->registerJs(<<<JS
$('#pedido_tipo  input[type="radio"]').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
});

$( '#pedido-clte_pedido' ).on( 'select2:select',function (){
});

$( 'body' ).on('select2:select',"select[id$='prod_pdetalle']",function(){
	let _currSelect = $( this );

  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  if ( checkDuplicate( _currSelect, row) )
  {
    _currSelect.val(null).trigger( 'change' );
    swal('Oops!!!',"El código no puede repetirse, ya está en la lista","error" );
    _currSelect.focus();
  }

  if ( _currSelect.val() )
  {
    setPrices( _currSelect.val(), row );
    $( '#pedidodetalle-' + row + '-cant_pdetalle' ).focus();
  }


});

$( '.table-body' ).on( 'change', 'input[id$="cant_pdetalle"]', function( e ){
    let row = $( this ).attr( "id" ).split( "-" );

    row = row[ 1 ];
    let cant = $( this ).val();
    let precio = $( "#pedidodetalle-" + row + "-precio_lista").val();
    let descu = $( "#pedidodetalle-" + row + "-descu_pdetalle").val();
    let total = 0;

    if ( cant ){
      if ( descu ){
        total = ( cant * (precio - (precio * (descu /100))));
      }
      else
      {
        total = cant * precio;
      }

      $( "#pedidodetalle-" + row + "-total" ).val( total );
    }

});

$( '.table-body' ).on( 'change', 'input[id$="descu_pdetalle"]', function( e ){
    let row = $( this ).attr( "id" ).split( "-" );

    row = row[ 1 ];
    let descu = $( this ).val();
    let precio = $( "#pedidodetalle-" + row + "-precio_lista").val();
    let cant = $( "#pedidodetalle-" + row + "-cant_pdetalle").val();
    let total = 0;
    let precioVenta = 0;
    if ( cant ){
      if ( descu ){
        total = ( cant * (precio - (precio * (descu /100))));
        precioVenta = precio - (precio * (descu /100));
      }
      else
      {
        total = cant * precio;
      }

      $( "#pedidodetalle-" + row + "-precio_pdetalle" ).val( precioVenta );
      $( "#pedidodetalle-" + row + "-total" ).val( total );
    }

});

$( '.table-body' ).on( 'change', 'input[id$="precio_pdetalle"]', function( e ){
    let row = $( this ).attr( "id" ).split( "-" );

    row = row[ 1 ];
    let cant = $( "#pedidodetalle-" + row + "-cant_pdetalle").val();
    let precio = $( this ).val();
    let total = 0;

    if ( cant ){
      total = cant * precio;
      $( "#pedidodetalle-" + row + "-total" ).val( total );
    }

});



$( '.table-body' ).on( 'keyup', 'input[id$="cant_pdetalle"]', function( e ){
  if ( e.keyCode === 13 && $( this ).val() )
  {
    let row = $( this ).attr( "id" ).split( "-" );

    row = row[ 1 ];

    $( '#pedidodetalle-' + row + '-descu_pdetalle' ).focus();

  }
});

$( '.table-body' ).on( 'keyup', 'input[id$="descu_pdetalle"]', function( e ){
  console.log( e.keyCode );
  if ( e.keyCode === 13 && $( this ).val() )
  {
    let row = $( this ).attr( "id" ).split( "-" );

    row = row[ 1 ];

    $( '#pedidodetalle-' + row + '-precio_pdetalle' ).focus();

  }
});

$( '.table-body' ).on( 'keyup', 'input[id$="precio_pdetalle"]', function( e ){

  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  if ( e.keyCode === 13 && $( this ).val() && $( "#pedidodetalle-" + row + "-prod_pdetalle").val()  )  {
      let rowR = getRow( row );

      swal({
        title: "¿Deseas agregar un  nuevo item?",
        icon: "info",
        buttons: true,
      })
      .then((willDelete) => {

        if (willDelete) {
          let row =  rowR(1);

          $( '.add-item' ).trigger( 'click' );
          $( "#pedidodetalle-" + ( parseInt(row) + 1 ) + "-prod_pdetalle").focus();
          $( "#pedidodetalle-" + ( parseInt(row) + 1 ) + "-prod_pdetalle").select2('open');
        }
      });
  }
});

function getRow( row = null ){
  if ( row ) {
    return function( ) {
      return row;
    }
  }
}

function checkDuplicate( _currSelect, row ) {
  let band = false;
  row = row[ 1 ];

  let selects = $("select[id$='prod_pdetalle']");

  for( let i = 0; i < selects.length - 1; i++)
  {
      if ( _currSelect.val() === $( selects[i] ).val() ){
        band = true;
        break;
      }
  }
  return band;
}

function setPrices( value = null, row )
{
  if ( value ){
    $.ajax({
        url:'?r=producto/product-price',
        data:{id: value},
        async:false,
        success: function( data )
        {
          if ( data.results )
          {
            $( '#pedidodetalle-' + row + '-precio_lista' ).val( data.results[ 0 ].precio );
            $( '#pedidodetalle-' + row + '-precio_pdetalle' ).val( data.results[ 0 ].precio );
          }
        }
    });
  }
}
JS
, VIEW::POS_END);

$this->registerJsFile(Yii::$app->getUrlManager()->getBaseUrl().'/js/dynamicform.js',
['depends'=>[\yii\web\JqueryAsset::className()],
'position'=>View::POS_END]);
