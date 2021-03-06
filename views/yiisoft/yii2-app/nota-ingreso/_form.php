<?php

use kartik\form\ActiveField;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\models\TipoMovimiento;
use app\models\TipoCambio;
use app\models\Compra;
use app\models\Almacen;
use app\models\Moneda;
use app\models\Producto;
use yii\web\View ;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\NotaIngreso */
/* @var $form yii\widgets\ActiveForm */

$disabledActivos = true;

if ( $model->isNewRecord ) {
  $model->codigo_trans = "0000000000";
  $disabledActivos = false;
  $model->fecha_trans = date('d/m/Y');
} else {
  $model->fecha_trans = date('d/m/Y',strtotime($model->fecha_trans));
}
$disabled = true;

if ( !$model->status_trans ) {
  $disabled = false;
}

$this->registerCss('
.disabled-select {
  background-color: #d5d5d5;
  opacity: 0.5;
  border-radius: 3px;
  cursor: no-drop;
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
}

select[readonly].select2-hidden-accessible + .select2-container {
  pointer-events: none;
  touch-action: none;
}

select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
  background: #eee;
  box-shadow: none;
}

select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow,
select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
  display: none;
  cursor: no-drop !important;
}
');
?>

<div class="nota-ingreso-form">

  <div class="container-fluid">
        <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true]); ?>
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?php echo Html::activeHiddenInput($model, "id_trans"); ?>
            <?= $form
            ->field($model, 'codigo_trans',['addClass' => 'form-control '])
            ->textInput([
              'maxlength' => true,
              'readonly' => true,
              'style' => ['text-align' => 'right'],
              'disabled' => $disabled
              ]) ?>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

            <?= $form->field($model, 'fecha_trans',[
              'addClass' => 'form-control'
              ])->textInput([
                'disabled' => $disabled,
                'value' => $model->fecha_trans,
                'readonly' => 'readonly',
                'style' => ['text-align' => 'right']
                ]) ?>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?= $form->field($model, 'docref_trans',[
              'addClass' => 'form-control'
              ])->textInput([
                'disabled' => $disabled,
                'maxlength' => true
                ]) ?>
          </div>
          <?php
            $display = "none";
            $class = "col-lg-6 col-md-6 col-sm-6 col-xs-12";
            $nroCompra = [];
            $arrCompras = [];
            $arrOptions = [];
            if ( !empty($model->idrefdoc_trans)) {
                $display = "block";
                $class = "ol-lg-3 col-md-3 col-sm-3 col-xs-12";
                $compras = Compra::getCompras();


                foreach ($compras as $key => $value) {
                    $arrCompras[$value['id_compra']] = $value['cod_compra'];
                    $arrOptions[$value['id_compra']]['data-details'] = json_encode($value['details']);
                    $arrOptions[$value['id_compra']]['data-moneda'] = json_encode($value['moneda_compra']);
                    $arrOptions[$value['id_compra']]['data-tipo_moneda'] = json_encode($value['tipo_moneda']);
                }

                $compras = [];
            }
          ?>
          <div id="tipo_trans" class="<?=$class?>>">
            <?php
            $mov = TipoMovimiento::getTipoMovList( 'E' );
            ?>
            <?= $form->field($model, 'tipo_trans',[
                'addClass' => 'form-control'
            ])->dropDownList(
                    $mov,
                    [
                        'custom' => true,
                        'prompt' => Yii::t('app','Select...'),
                        'id'=>'notaingreso-tipo_trans',
                        'disabled' => $disabledActivos,
                    ]
            ) ?>
          </div>

          <div id="nro_compra" class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display: <?=$display?>">
            <?php
            $url = Url::to(['compra/ajax-compras']);

            $compra = empty($model->idrefdoc_trans) ? '' : Compra::findOne($model->idrefdoc_trans)->cod_compra;
            echo $form->field($model, 'idrefdoc_trans',[
                'addClass' => 'form-control ',
                'hintType' => ActiveField::HINT_SPECIAL
            ])->dropDownList( $arrCompras,[
                    'id' => 'idrefdoc_trans',
                    'prompt' => Yii::t('app','Select...'),
                    'options' => $arrOptions
            ]);
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php $almacenes = Almacen::getAlmacenList();?>

            <?= $form->field($model, 'almacen_trans',[
                'addClass' => 'form-control'
              ])->widget(Select2::classname(), [
                        'data' => $almacenes,
                        'language' => Yii::$app->language,
                        'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-archive"></i>']],
                        'options' => ['placeholder' => Yii::t('almacen','Select a warehouse').'...'],
                        'theme' => Select2::THEME_DEFAULT,
                        'disabled' => $disabledActivos,
                        // 'pluginOptions' => [
                        //     'allowClear' => true
                        // ],

                ]) ?>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <?php
                $monedas = Moneda::getMonedasList();
              ?>
              <?= $form->field($model, 'moneda_trans',[
              'addClass' => 'form-control ',
                ])->widget(Select2::classname(), [
                          'data' => $monedas,
                          'language' => Yii::$app->language,
                          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-money"></i>']],
                          'options' => ['placeholder' => Yii::t('moneda','Select a currency').'...'],
                          'theme' => Select2::THEME_DEFAULT,
                          'disabled' => $disabledActivos,
                  ])?>
            </div>
        </div>


        <!-- Articulos -->
        <div class="row">
          <div class="container-fluid">
            <?php DynamicFormWidget::begin([
                  'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                  'widgetBody' => '.table-body', // required: css class selector
                  'widgetItem' => '.detalle-item', // required: css class
                  'limit' => 60, // the maximum times, an element can be cloned (default 999)
                  'min' => 0, // 0 or 1 (default 1)
                  'insertButton' => '.add-item', // css class
                  'deleteButton' => '.remove-item', // css class
                  'model' => $modelsDetalles[0],
                  'formId' => $model->formName(),
                  'formFields' => [
                      'id_detalle',
                      'prod_detalle',
                      'cant_detalle',
                  ],
              ]); ?>

              <div class="row">
                  <div class="col-sm-1 col-xs-12">#</div>
                  <div class="col-sm-6 col-xs-12"><?= Yii::t( 'pedido', 'Product')?></div>
                  <div class="col-sm-2 col-xs-12"><?= Yii::t( 'pedido', 'Qtty')?></div>
                  <div class="col-sm-2 col-xs-12"><?= Yii::t( 'ingreso', 'Cost')?></div>
                  <div class="col-sm-1 col-xs-12">
                    <button type="button" class="add-item btn btn-success btn-flat btn-md"
                    style="width:100%"  data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Add item')?>"
                    <?=$disabled ? 'disabled':''?>>
                      <i class="fa fa-plus"></i>
                    </button>
                  </div>
              </div>
              <hr>
              <div class="table-body"><!-- widgetContainer -->
              <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
                      <div class="row detalle-item"><!-- widgetBody -->
                        <div class="col-sm-1 col-xs-12 nro">
                          <?= ( $index + 1 )?>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                        <?php
                          // necessary for update action.
                          if (!$modelDetalle->isNewRecord) {
                              echo Html::activeHiddenInput($modelDetalle, "[{$index}]id_detalle");
                              //$modelSucursal->empresa_suc[$index] = $model->id_empresa;
                              echo Html::activeHiddenInput($modelDetalle, "[{$index}]trans_detalle");
                          }

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


                          $url = Url::to(['producto/producto-list']);

                          $producto = [];

                          if ( !empty($modelDetalle->prod_detalle) )
                          {
                            $producto = Producto::findOne($modelDetalle->prod_detalle);
                          }

                          $productos = empty($modelDetalle->prod_detalle) ? '' : $producto->cod_prod.' '.$producto->des_prod.' - '.$producto->umedProd->des_und;
                          echo $form->field($modelDetalle, "[{$index}]prod_detalle",[
                            'addClass' => 'form-control ',
                            ])->widget(Select2::classname(), [
                              'language' => Yii::$app->language,
                              'initValueText' => $productos, // set the initial display text
                              'options' => ['placeholder' => Yii::t('producto','Select a product').'...'],
                              'theme' => Select2::THEME_DEFAULT,
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
                                  'data' => new JsExpression('function(params) { return {desc:params.term}; }'),
                                  'processResults' => new JsExpression($resultsJs),
                              ],
                              'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
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
                              'disabled' => $disabled,
                          ])->label(false);
                          ?>
                        </div>

                        <div class="col-sm-2 col-xs-12">
                          <?= $form
                          ->field($modelDetalle,"[{$index}]cant_detalle",[ 'addClass' => 'form-control number-integer'])
                          ->textInput([
                            'type' => 'number',
                            'min' => 1,
                            'pattern' => "\d*",
                            'disabled' => $disabled
                          ])->label(false)?>
                        </div>
                        <div class="col-sm-2 col-xs-12">
                          <?= $form
                          ->field($modelDetalle,"[{$index}]costo_detalle",[ 'addClass' => 'form-control number-decimals'])
                          ->textInput([
                            'type' => 'number',
                            'min' => 1,
                            'pattern' => "\d*",
                            'disabled' => $disabled
                          ])->label(false)?>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                          <button type="button" class="remove-item btn btn-danger btn-flat btn-sm" style="width:100%"
                          data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Delete item')?>" <?=$disabled ? 'disabled':''?>>
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                    </div>
              <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
          </div>
        </div><!-- Articulos -->
        <hr>
        <div class="row">
          <div class="col-lg-12 col-xs-12">
              <?= $form->field($model, 'obsv_trans')->textarea(['rows' => 3, 'disabled' => $disabled]) ?>
          </div>
        </div>

        <div class="row">
            <div class="form-group" style="float:right">
             <?php if ( !$model->isNewRecord ) { ?>
                <button type="button" name="button" id="imprimir" data-toggle="modal" class="btn btn-flat btn-primary"><span class="fa fa-print"></span> <?= Yii::t('app', 'Print')?></button>
             <?php } ?>


                <button id="submit" type="button" class="btn btn-flat btn-success" <?=$disabled ? 'disabled':''?>><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
            </div>
          </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
<?php
$this->registerJsFile(Yii::$app->getUrlManager()->getBaseUrl().'/js/dynamicform.js',
['depends'=>[\yii\web\JqueryAsset::className()],
'position'=>View::POS_END]);

$this->registerCss("
select[readonly].select2+.select2-container {
  pointer-events: none;
  touch-action: none;
}

.select2{
  width: 100%;
}
");

$this->registerJsVar( "buttonPrint", "#imprimir" );
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);

$jsTrigger = "";

if ( !$model->isNewRecord ) {
    $jsTrigger = '
    let compra = ' . (!empty($model->idrefdoc_trans) ? $model->idrefdoc_trans : 0) . ';
    $( ".table-body input[id$=\'cant_detalle\']" ).trigger( "change" );

    if ( compra ) {
        $( ".table-body select[id$=\'prod_detalle\']").attr("readonly", true);
        $( ".table-body input[id$=\'cant_detalle\']").prop(\'readonly\',true);
        $( ".table-body input[id$=\'costo_detalle\']").prop(\'readonly\',true);
        $( ".table-body .remove-item").prop(\'disabled\',true);
        $( ".add-item").css(\'display\',"none");
    }
  ';
}

$js = '

$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    //console.log("beforeInsert");
});
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    //console.log("afterInsert");
    $(item).find("input,textarea,select").each(function(index,element){
       $(element).val("");
    });
    let row = $(".table-body select").length - 1;
    $( "#notaingresodetalle-" + row + "-prod_detalle" ).val(null).trigger("change");

    jQuery(".dynamicform_wrapper .nro").each(function(index) {
        jQuery(this).html(index + 1)
    });
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
  if ( confirm("'.Yii::t('producto','Are you sure to delete this product?').'") ) {
    return true;
  }
  return false;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
    jQuery(".dynamicform_wrapper .nro").each(function(index) {
        jQuery(this).html(index + 1)
    });
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});

$( buttonPrint ).on( "click", function(){
  $( frameRpt ).attr( "src", "'.Url::to(['nota-ingreso/notai-rpt', 'id' => $model->id_trans]).'");
  $( modalRpt ).modal({
    backdrop: "static",
    keyboard: false,
  });
  $( modalRpt ).modal("show");
});


$( ".table-body" ).on("select2:select","select[id$=\'prod_detalle\']",function() {
	let _currSelect = $( this );
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  let selects = $("select[id$=\'prod_detalle\']");

  if ( checkDuplicate( _currSelect, row, selects) ) {
    _currSelect.val( null ).trigger( "change" );
    swal( "Oops!!!","'. Yii::t('app','Code can´t be repeated, it is already in the list') .'","error" );
    _currSelect.focus();
  }

  setCosts( $( this ).val(), row );

  $( "#notaingresodetalle-" + row + "-cant_detalle" ).focus();

});


$( ".table-body" ).on( "keyup","input[id$=\'cant_detalle\']",function( e ) {
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  if ( e.keyCode === 13 && $( this ).val() ) {
    $( "#notaingresodetalle-" + row + "-costo_detalle" ).focus();
  }

});
$( ".table-body" ).on( "keyup","input[id$=\'costo_detalle\']",function( e ) {
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  if ( e.keyCode === 13 && $( this ).val() ) {
    swal({
      title: "' . Yii::t( 'app','Do you want to add a new item?') . '",
      icon: "info",
      buttons: true,
    }).then( ( willDelete ) => {
      if ( willDelete ) {
        let row = $( ".detalle-item" ).length;

        $( ".add-item" ).trigger( "click" );
        $( "#notaingresodetalle-" + row + "-prod_detalle").focus();
        $( "#notaingresodetalle-" + row + "-prod_detalle").select2("open");
        $( "#notaingreso-moneda_trans").attr("readonly", true);
        $( "#notaingreso-almacen_trans").attr("readonly", true);

      }
    });
  }
});



$( "#submit" ).on( "click", function() {
  let form = $( "form#' . $model->formName() . '" );

  let rows = $(".table-body > .detalle-item").length;

  if ( !rows ) {
    swal("'.Yii::t('ingreso','Entry note').'", "'.Yii::t('compra','The order must have at least one item to be saved').'", "info");
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
            title: "'.Yii::t("compra","Do you want to issue the document?").'",
            icon: "info",
            buttons: true,
            dangerMode: true,
          })
          .then((willIssue) => {
            if (willIssue) {
              window.open("'.Url::to(['pedido/pedido-rpt']).'&id=" + data.id,"_blank");
            }
          });

          $( ".table-body" ).empty();
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

$( "body" ).on( "click", buttonCancel, function(){
  $( frameRpt ).attr( "src", "about:blank" );
  $( modalRpt ).modal("hide");
});

';

$js2 = "
$( \"#notaingreso-tipo_trans\" ).on(\"change\", function(){
    let val = $( \"#notaingreso-tipo_trans option:selected\" ).val();

    if( val == " . Compra::TIPO_MOVIMIENTO . "){
        $( this ).parent().parent().switchClass( \"col-lg-6\", \"col-lg-3\", 1000, \"easeInOutQuad\" );
        $( this ).parent().parent().switchClass( \"col-md-6\", \"col-md-3\", 1000, \"easeInOutQuad\" );
        $( this ).parent().parent().switchClass( \"col-sm-6\", \"col-sm-3\", 1000, \"easeInOutQuad\" );
        setTimeout( function(){
            $( \"#nro_compra\" ).css( \"display\", \"block\");
        }, 1050);

        $.post('" . Url::to(['compra/ajax-compras']) . "', function( data ) {
            $(\"#idrefdoc_trans\").empty();
            let s = new Option('" . Yii::t('app','Select') . "', '');
            $(s).html('" . Yii::t('app','Select') . "');
            $('#idrefdoc_trans').append(s);
            $.each(data, function(key, value) {
                option = '<option value=\"' + value.id_compra + '\" ' +
                         'data-moneda=\"' + JSON.stringify(value.moneda_compra) + '\" ' +
                         'data-tipo_moneda=\"' + value.tipo_moneda + '\" ' +
                         'data-details=\'' + JSON.stringify(value.details) + '\'>' + value.cod_compra + '</option>';
                $('#idrefdoc_trans').append(option);
             });
        } );

        $(\".add-item\").hide( \"drop\", { direction: \"down\" }, 1000 );



    } else {
        $( \"#nro_compra\" ).css( \"display\", \"none\");
        $( this ).parent().parent().switchClass( \"col-lg-3\", \"col-lg-6\", 1000, \"easeInOutQuad\" );
        $( this ).parent().parent().switchClass( \"col-md-3\", \"col-md-6\", 1000, \"easeInOutQuad\" );
        $( this ).parent().parent().switchClass( \"col-sm-3\", \"col-sm-6\", 1000, \"easeInOutQuad\" );
        $(\".add-item\").show( \"drop\", { direction: \"up\" }, 1000 );

        $( \" .table-body select[id$='prod_detalle']\").prop('readonly',false);
        $( \" .table-body select[id$='cant_detalle']\").prop('readonly',false);
        $( \" .table-body select[id$='costo_detalle']\").prop('readonly',false);
        $( \" .table-body .delete-item\").prop('disabled',false);
        $( \".table-body select[id$='prod_detalle']\").val(null).change();
    }
    $( \".table-body\" ).empty();
});
";

$js2 .= '
$("#idrefdoc_trans").on("change", function( e ){
    let option = $( "#" + this.id + " option:selected" );
    let details =  $(option).data("details");
    let options = [];

    $( "#notaingreso-moneda_trans" ).val( $( option ).data("moneda") ).trigger( "change" );
    $( "#notaingreso-moneda_trans" ).prop( "readonly", true );
    $( ".table-body" ).empty();

    $.each(details, function(i,value){
        $( ".add-item" ).trigger("click");
        let s = new Option(value.des_prod, value.id_prod);
        $(s).html(value.des_prod);
        options.push( $(s) );
    });

    $( ".table-body select[id$=\'prod_detalle\']").append(options);

    $.each(options, function( i,value){
        $( "select#notaingresodetalle-" + i + "-prod_detalle" ).val(value.val()).trigger("change");
        $( "input#notaingresodetalle-" + i + "-cant_detalle" ).val(details[i].cant_detalle);
        $( "input#notaingresodetalle-" + i + "-costo_detalle" ).val(details[i].costo_detalle);
    });

    $( ".table-body select[id$=\'prod_detalle\']").attr("readonly", true);
    $( ".table-body input[id$=\'cant_detalle\']").prop(\'readonly\',true);
    $( ".table-body input[id$=\'costo_detalle\']").prop(\'readonly\',true);
    $( ".table-body .remove-item").prop(\'disabled\',true);
});

function setCosts( value = null, row ) {
  if ( value ) {
    $.ajax({
        url:"'.Url::to(['producto/product-costo']).'",
        data:{
          id: value,
        },
        async: false,
        success: function( data ) {
          if ( data.results.length ) {
            let tipoCambio = '.json_encode(TipoCambio::getTipoCambio()).';
            let costo = +data.results[ 0 ].costo;
            let tipoMoneda = data.results[ 0 ].tipo_moneda;
            let moneda = +data.results[ 0 ].moneda_compra;
            let tm = $("#notaingreso-moneda_trans option:selected").html().split(" - ")[1];
            let mon = +$("#notaingreso-moneda_trans option:selected").val();


            if ( tipoMoneda !== tm && tm === "E" ) {
              costo = costo / tipoCambio.valorf_tipoc;
            }

            costo = parseFloat(  costo  ).toFixed( 2 );
            $( "#notaingresodetalle-" + row + "-costo_detalle" ).val( costo );
          }
        }
    });
  }
}
';
$this->registerJs($js.$jsTrigger.$js2,View::POS_LOAD);
$this->registerJsFile(Yii::$app->getUrlManager()->getBaseUrl().'/js/dynamicform.js',
    ['depends'=>[\yii\web\JqueryAsset::className()],
        'position'=>View::POS_END]);
