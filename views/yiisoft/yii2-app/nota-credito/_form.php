<?php

use app\models\TipoDocumento;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Documento;
use app\models\MotivoNcredito;
use app\models\Vendedor;
use app\models\Moneda;
use app\models\Almacen;
use app\models\CondPago;
use app\models\Producto;
use app\models\Numeracion;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\form\ActiveField;
use yii\web\View ;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use app\base\Model;
/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="documento-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="form-group">
                  <label for="tipo_doc-search"><?= Yii::t('tipo_documento','Document type')?></label>
                  <?= Html::dropDownList(
                          'tipo_doc-search',
                          null,
                          ArrayHelper::map(
                                  Numeracion::find()
                                      ->select(['id_num','concat(td.abrv_tipod,"/",serie_num," - ",td.des_tipod) numero_num'])
                                      ->joinWith(['tipoDocumento td'])
                                      ->where([
                                              'td.tipo_tipod' => TipoDocumento::ES_DOCUMENTO,
                                              'td.ope_tipod' => TipoDocumento::TD_SALIDA
                                      ])
                                      ->orderBy('td.abrv_tipod asc,serie_num asc')->all(), 'id_num', 'numero_num'),
                          [
                                  'prompt' => Yii::t('app','Select'),
                                  'class' => 'form-control',
                                  'id' => 'tipo_doc-search'
                          ]
                      ) ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="num_doc"><?= Yii::t('documento','Code')?></label>
                <?= Html::input('text', '', '', ['id' => 'cod_doc-search','class' => 'form-control', 'style' => ['text-align' => 'right'], 'maxlength' => 10])  ?>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label></label>
                <button id="search"  class="btn btn-flat btn-success" style="width:100%"><?= Yii::t('app','Search');?>&nbsp; &nbsp;<i class="fa fa-search"></i></button>
            </div>

        </div>
    </div>
</div>


<div id="await" style="display:none;">
  <div class="nota-credito">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= Yii::t('documento','Credit note') ?>
        </h3>
      </div>
      <div class="box-body">
        <div class="overlay">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="documento" style="display:none;">
  <div class="nota-credito">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= Yii::t('documento','Credit note') ?>
        </h3>
      </div>
      <div class="box-body">
        <div class="nota-credito-form">
          <div class="container-fluid">

              <?php $form = ActiveForm::begin([ 'id' => $model->formName(),'enableClientScript' => true]); ?>
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="tipo_doc"><?= Yii::t('documento','Type')?></label>
                    <?= Html::input('text', 'NotaCredito[tipo_doc]', '', [
                                                                          'id'       => 'tipo_doc',
                                                                          'class'    => 'form-control',
                                                                          'maxlength' => 2,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                  </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="serie_doc"><?= Yii::t('documento','Serie')?></label>
                    <?= Html::input('text', 'NotaCredito[serie_doc]', '', [
                                                                          'id'       => 'serie_doc',
                                                                          'class'    => 'form-control',
                                                                          'style'    => [
                                                                                        'text-align' => 'right'
                                                                                      ],
                                                                          'maxlength' => 2,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="cod_doc"><?= Yii::t('documento','Code')?></label>
                    <?= Html::input('text', 'NotaCredito[cod_doc]', '', [
                                                                          'id'        => 'cod_doc',
                                                                          'class'     => 'form-control',
                                                                          'style'     => [
                                                                                        'text-align' => 'right'
                                                                                      ],
                                                                          'maxlength' => 10,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                    <?= Html::hiddenInput('NotaCredito[id_doc]', '',[ 'id' => 'NotaCredito-id_doc']);?>
                  </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <!-- Fecha documento -->
                  <div class="form-group">
                    <label class="control-label" for="fecha_doc"><?= Yii::t('documento','Date')?></label>
                    <?= Html::input('text', 'NotaCredito[fecha_doc]', '', [
                                                                          'id'        => 'fecha_doc',
                                                                          'class'     => 'form-control',
                                                                          'style'     => [
                                                                                        'text-align' => 'right'
                                                                                      ],
                                                                          'maxlength' => 10,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <!-- Cliente -->
                  <label class="control-label" for="nota_credito-nombre_cliente"><?= Yii::t('cliente','Name')?></label>
                  <?= Html::input('text', 'NotaCredito[nombre_cliente]', '', [
                                                                        'id'        => 'nombre_cliente',
                                                                        'class'     => 'form-control',
                                                                        'maxlength' => 10,
                                                                        'readonly'  => true,
                                                                      ])  ?>
                  <!-- lista Precios -->
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="notacredito-direcc_clte"><?= Yii::t('cliente','Address') ?></label>
                    <!-- Direccion -->
                    <?= Html::textarea('NotaCredito[direcc_cliente]', '', [
                                                                          'id'        => 'direcc_cliente',
                                                                          'class'     => 'form-control',
                                                                          'maxlength' => 10,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <div class="form-group">
                      <!-- Moneda -->
                      <label class="control-label" for="nombre_cliente"><?= Yii::t('moneda','Currency')?></label>
                      <?= Html::input('text', 'NotaCredito[moneda_pedido]', '', [
                        'id'        => 'moneda_pedido',
                        'class'     => 'form-control',
                        'maxlength' => 10,
                        'readonly'  => true,
                        ])  ?>
                  </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="motivo_doc"><?= Yii::t('cliente','Motivo')?></label>
					<?php
						$motivosNcredito = MotivoNcredito::getMotivos();
					?>
                    <?= Html::dropDownList('NotaCredito[motivo_doc]', null,$motivosNcredito,
                                                              [
                                                                'prompt' => Yii::t('app','Select'),
                                                                'class' => 'form-control',
                                                                'id'    => 'motivo_doc'
                                                              ]
                                                              ) ?>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <div class="form-group">
                      <label class="control-label" for="stock_prod"><?= Yii::t('tipo_movimiento',"Movement type")?></label>
                      <?= Html::dropDownList('NotaCredito[tipom_doc]', null, [
                                                                                  //0  => 'No mover stock',
                                                                                  1  => 'Reponer stock'
                                                                               ],
                                                                               [
                                                                                    'prompt' => Yii::t('app','Select'),
                                                                                   'class' => 'form-control',
                                                                                   'id'    => 'tipo_movimiento',
                                                                               ]) ?>
                  </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <div class="form-group">
                      <!-- Almacen -->
                      <?php
                        $almacenes = Almacen::getAlmacenList();
                      ?>
                          <label class="control-label" for="almacen_doc"><?= Yii::t('almacen',"Warehouse")?></label>
                          <?= Html::dropDownList('NotaCredito[almacen_doc]', null, $almacenes, [
                            'class'  => 'form-control',
                            'id'     => 'almacen_doc',
                            'prompt' => Yii::t('app','Select'),
                          ]) ?>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <div class="form-group">
                      <!-- Condicion de pago -->
                      <?php
                        $condp = CondPago::getCondPagoList();
                      ?>
                      <label class="control-label" for="condpago_doc"><?= Yii::t('condicionp',"Payment condition")?></label>
                      <?= Html::dropDownList('NotaCredito[condpago_doc]', null, $condp, [
                        'class'  => 'form-control',
                        'id'     => 'condpago_doc',
                        'prompt' => Yii::t('app','Select'),
                      ]) ?>
                    </div>
                </div>
              </div>
              <div class="row" >
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="tipod_doc-notacredito"><?= Yii::t('tipo_documento','Document type')?></label>
                    <?php
                    $tiposDoc = TipoDocumento::getTipoDocumento( 'E', TipoDocumento::ES_DOCUMENTO );

                    $tipoDocs = [];
                    $dataTipoDocs = [];
                    for ($i = 0; $i < count($tiposDoc); $i++ ){
                      // code...
                      $tipoDocs[$tiposDoc[$i]['id_num']]    = $tiposDoc[$i]['des_tipod'];
                    }?>
                    <?= Html::dropDownList('NotaCredito[tipod_doc]', null, $tipoDocs, [
                      'class'  => 'form-control',
                      'id'     => 'tipod_doc-notacredito',
                      'prompt' => Yii::t('app','Select'),
                    ]) ?>
                  </div>
                  <div class="form-group">
                    <label for="cod_doc-notacredito"><?= Yii::t('documento','Code')?></label>
                    <?= Html::input('text', 'NotaCredito[cod_doc]', '', [
                                                                          'id'        => 'cod_doc-notacredito',
                                                                          'class'     => 'form-control',
                                                                          'style'     => [
                                                                                        'text-align' => 'right'
                                                                                      ],
                                                                          'maxlength' => 10,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                  </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group" style="padding-top:5%">
                      <a id="save-doc" class="btn btn-lg btn-flat btn-success" style="width:100%;">
                        <i class="fa fa-save"></i> <?= Yii::t('app', 'Save')?>
                      </a>
                    </div>
                </div>
              </div>
              <br>
              <!-- Articulos -->
              <div class="row">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-1 col-xs-12" style="text-align:center"><?= Yii::t( 'app', 'Select')?> <input id="checkallddetalle" name="checkallddetalle" class="minimal" type="checkbox"></div>
                    <div class="col-sm-6 col-xs-12"><?= Yii::t( 'pedido', 'Product')?></div>
                    <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Qtty')?></div>
                    <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'L. price')?></div>
                    <!--th class="col-xs-1"><?= Yii::t( 'pedido', 'Tax')?></th-->
                    <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Disc.')?></div>
                    <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Price')?></div>
                    <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Total')?></div>
                  </div>
                  <hr>
                  <div class="table-body"><!-- widgetContainer -->

                  </div>
                  <!-- Articulos -->
                </div>
              </div>
              <div class="row">
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
                        <?= Yii::t('app', 'Tax')?> <?=  $IMPUESTO ?>%
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
          </div>
        </div>


              <?php
              /*
              * Campos ocultos pero necesarios
              */
              // Campo de usuario

              //$form->field($model, 'usuario_pedido')->textInput()
              //$form->field($model, 'estatus_pedido')->textInput()
              //$form->field($model, 'sucursal_pedido')->textInput()
               /*

               <div class="form-group" style="float:right">
                <?php if ( !$model->isNewRecord ) { ?>
                   <button type="button" name="button" id="imprimir" data-toggle="modal" class="btn btn-flat btn-primary "><span class="fa fa-print"></span> <?= Yii::t('app', 'Print')?></button>
                <?php } ?>
                   <button id="submit" type="button" class="btn btn-flat btn-success"><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
               </div> */ ?>
      <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>



<?php

$js = '

   $( "#cod_doc-search" ).on( "blur", function() {
     let value = $(this).val();

     if ( value && isFinite( value ) ) {
        return $( this ).val( value.padStart( 10, "0") );
     }

     return $( this ).val();
   });

   $( "#search" ).on( "click", function() {
     $( "#tipo_doc-search" ).parent().removeClass("has-error");
     $( "#cod_doc-search" ).parent().removeClass("has-error");


     if ( !$( "#tipo_doc-search" ).val() ) {
        swal("Opps","' . Yii::t('documento', 'You must select a document type') . '","error");
        $( "#tipo_doc-search" ).parent().addClass("has-error");
        $( "#tipo_doc-search" ).focus();
        return;
     }

     if ( !$("#cod_doc-search").val() ) {
        swal("Oops","' . Yii::t('documento', 'You must input a document number'). '","error");
        $("#cod_doc-search").parent().addClass("has-error");
        $("#cod_doc-search").focus();
        return;
     }

     $.ajax({
        url       : "'. Url::to(['nota-credito/get-documento']).'",
        data      : {
                tipo   : $( "#tipo_doc-search" ).val(),
                numero : $( "#cod_doc-search" ).val(),
              },
        async     : true,
        beforeSend: function () {
          $( "#await" ).css( "display", "block" );
          setTimeout(() => { console.log( "Loading..."); }, 80);
        },
        success   : function( data ) {
          console.log("success");
          $( "#await" ).css( "display", "none" );
          if ( data.anulado ) {
            swal("Oops!!!","' . Yii::t( 'app', 'Record canceled!')  . '","warning" );
            $( "#documento" ).css( "display", "none" );
            return;
          }

          if ( !data ) {
            swal("Oops!!!","' . Yii::t( 'app', 'Record not found!')  . '","warning" );
            $( "#documento" ).css( "display", "none" );
            return;
          }
          buildForm( data );
          calculateTotals( IMPUESTO );
        },
        error    : function( data ) {
          let message;

          if ( data.responseJSON ) {
            let error = data.responseJSON;
            message =   "Se ha encontrado un error: " +
              "\n\nCode " + error.code +
              "\n\nFile: " + error.file +
              "\n\nLine: " + error.line +
              "\n\nName: " + error.name +
              "\n Message: " + error.message;
          } else {
              message = data.responseText;
          }

          swal("Oops!!!",message,"error" );
          $( "#documento" ).css("display","none");
        }
     });
   });

   $( "#documento" ).on( "ifChanged", "input#checkallddetalle", function (event) {
     $("input[id$=\'check_ddetalle\']").prop(\'checked\',$(this).is(":checked")).iCheck(\'update\');
     calculateTotals( IMPUESTO );
   });

   $( ".table-body" ).on( "ifChanged", "input[id$=\'check_ddetalle\']", function (event) {
     if ( !$( this ).prop("checked") ) {
       $( "input#checkallddetalle" ).prop(\'checked\',false).iCheck(\'update\');
     }

     if ( $("input[id$=\'check_ddetalle\']:checked").length === $("input[id$=\'check_ddetalle\']").length ) {
       $( "input#checkallddetalle" ).prop(\'checked\',true).iCheck(\'update\');
     }
     calculateTotals( IMPUESTO );

   });



   $( ".table-body" ).on( "change", "input[id$=\'cant_ddetalle\']", function() {
     let row = this.id.split( "-" );

     let valor     = +$( this ).val();
     let valorFact = +$( this ).data( "cant" );
     let precio    = +$( "#NotaCredito_Detalle-" + row[1] + "-precio_ddetalle" ).val();
     let total = 0;

     if ( valor > valorFact ) {
       swal( "Oops!", "'. Yii::t('documento','Input quantity can´t be greather than billed quantity') .'", "warning");
       $( this ).val( valorFact.toFixed(2) );
       total = valorFact * precio;
       $( "#NotaCredito_Detalle-" + row[1] + "-total_ddetalle" ).val( total.toFixed(2) );
       $( this ).focus();
       return;
     }

     $( "#NotaCredito_Detalle-" + row[1] + "-check_ddetalle" ).prop(\'checked\',true).iCheck(\'update\');

     total = valor * precio;
     $( "#NotaCredito_Detalle-" + row[1] + "-total_ddetalle" ).val( round( total ) );

     calculateTotals(IMPUESTO);
   });

   function calculateTotals(IMPUESTO) {
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

     $( "input[id$=\\"-total_ddetalle\\"]" ).each(function (i, element) {
        if ( $( "#NotaCredito_Detalle-" + i + "-check_ddetalle" ).prop(\'checked\') ) {
           let row = $( this ).attr( "id" ).split( "-" );
           row = row[ 1 ];
           total += +element.value;
           let valDesc = $( "#NotaCredito_Detalle-" + row + "-plista_ddetalle" ).val() - $( "#NotaCredito_Detalle-" + row + "-precio_ddetalle" ).val();
           subT = $( "#NotaCredito_Detalle-" + row + "-precio_ddetalle" ).val()  *  $( "#NotaCredito_Detalle-" + row + "-cant_ddetalle" ).val() / ( IMPUESTO + 1 ) ;
           desc = valDesc * $( "#NotaCredito_Detalle-" + row + "-cant_ddetalle" ).val()   / ( IMPUESTO + 1 ) ;
           subTotal1 += subT - desc;
           descuento += desc;
        }
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
   }

   function buildForm( data ) {
      $( "#documento" ).css("display","block");
      $( ".table-body" ).empty();
      for(opc in data) {
        $( "input[id$=\'" + opc + "\']" ).val( data[opc] );
        $( "textarea[id$=\'" + opc + "\']" ).val( data[opc] );

        if (opc == "detalle_pedido") {
          for(deta in data[opc]) {
            let linea  = "<div class=\\"row detalle-item\\"><!- widgetBody -->" +
                           "<div class=\\"col-sm-1 col-xs-12\\" style=\\"text-align:center\\">"+
                                "<input id=\\"NotaCredito_Detalle-" + deta + "-check_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][check_ddetalle]\\" "+
                                " class=\\"minimal\\" type=\\"checkbox\\" >" +
                           "</div>"+
                           "<div class=\\"col-sm-6 col-xs-12\\">"+
                                "<input id=\\"NotaCredito_Detalle-" + deta + "-prod_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][prod_ddetalle]\\" "+
                                " class=\\"form-control\\" value=\\"" + data[opc][deta]["codprod_pdetalle"].trim() + " - " +
                                  data[opc][deta]["desc_pdetalle"].trim() + " - " + data[opc][deta]["umed_pdetalle"].trim()  + "\\" readonly>" +
                                "<input type=\\"hidden\\" name=\\"NotaCredito-Detalle[" + deta + "][prod_ddetalle]\\" value=\\"" + +data[opc][deta]["prod_pdetalle"] + "\\"> "+
                                "<input type=\\"hidden\\" name=\\"NotaCredito-Detalle[" + deta + "][id_pdetalle]\\" value=\\"" + +data[opc][deta]["id_pdetalle"] + "\\"> "+
                            "</div>"+
                            "<div class=\\"col-sm-1 col-xs-12\\">"+
                                "<input id=\\"NotaCredito_Detalle-" + deta + "-cant_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][cant_ddetalle]\\" "+
                                " class=\\"form-control number-integer\\" value=\\"" + data[opc][deta]["cant_pdetalle"] + "\\" data-cant=\\"" + data[opc][deta]["cant_pdetalle"] + "\\">" +
                            "</div>"+
                            "<div class=\\"col-sm-1 col-xs-12\\">"+
                                "<input id=\\"NotaCredito_Detalle-" + deta + "-plista_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][plista_ddetalle]\\" "+
                                " class=\\"form-control number-decimals\\" value=\\"" + data[opc][deta]["plista_pdetalle"] + "\\" readonly>" +
								"<input id=\\"NotaCredito-Detalle-" + deta + "-impuesto_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][impuesto_ddetalle]\\" value=\\"" +
								data[opc][deta]["impuesto_pdetalle"] + "\\" type=\\"hidden\\">" +
                            "</div>"+
                            "<div class=\\"col-sm-1 col-xs-12\\">"+
                                "<input id=\\"NotaCredito_Detalle-" + deta + "-descu_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][descu_ddetalle]\\" "+
                                " class=\\"form-control number-decimals\\" value=\\"" + data[opc][deta]["descu_pdetalle"] + "\\" readonly>" +
                            "</div>"+
                            "<div class=\\"col-sm-1 col-xs-12\\">"+
                                "<input id=\\"NotaCredito_Detalle-" + deta + "-precio_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][precio_ddetalle]\\" "+
                                " class=\\"form-control number-decimals\\" value=\\"" + data[opc][deta]["precio_pdetalle"] + "\\" readonly>" +
                            "</div>"+
                            "<div class=\\"col-sm-1 col-xs-12\\">"+
                                "<input id=\\"NotaCredito_Detalle-" + deta + "-total_ddetalle\\" name=\\"NotaCredito-Detalle[" + deta + "][total_ddetalle]\\" "+
                                " class=\\"form-control number-decimals\\" value=\\"" + data[opc][deta]["total_pdetalle"] + "\\" readonly>" +
                            "</div>"+
                         "</div>";
            $( ".table-body" ).append( linea );
            $()
          }
        }

        $("input[type=\\"checkbox\\"].minimal, input[type=\\"radio\\"].minimal").iCheck({
          checkboxClass: "icheckbox_minimal-blue",
          radioClass   : "iradio_minimal-blue"
        });
      }

   }

   $( "#tipod_doc-notacredito" ).on( "change", function(){
     $.ajax({
       url     : "'.Url::to(['tipo-documento/ajax-tipo-documento']).'",
       data    : { id: this.value },
       success : function ( data ) {
         $( "#cod_doc-notacredito" ).val( data );
       }
     })
   });

   $( "a#save-doc" ).on("click", function() {
     $( "#motivo_doc" ).parent().removeClass("has-error");
     $( "#tipo_movimiento" ).parent().removeClass("has-error");
     $( "#almacen_doc" ).parent().removeClass("has-error");
     $( "#condpago_doc" ).parent().removeClass("has-error");

     if ( !$( "#motivo_doc" ).val() ) {
        swal("Oops","' .Yii::t('documento', 'You must select a reason').'","error");
        $( "#motivo_doc" ).parent().addClass("has-error");
        $( "#motivo_doc" ).focus();
        return;
     }

     if ( !$( "#tipo_movimiento" ).val() ) {
        swal("Oops","' .Yii::t('documento', 'You must select a movement type').'","error");
        $( "#tipo_movimiento" ).parent().addClass("has-error");
        $( "#tipo_movimiento" ).focus();
        return;
     }

     if ( !$( "#almacen_doc" ).val() ) {
        swal("Oops","' .Yii::t('documento', 'You must select a warehouse').'","error");
        $( "#almacen_doc" ).parent().addClass("has-error");
        $( "#almacen_doc" ).focus();
        return;
     }

     if ( !$( "#condpago_doc" ).val() ) {
        swal("Oops","' .Yii::t('documento', 'You must select a payment condition').'","error");
        $( "#condpago_doc" ).parent().addClass("has-error");
        $( "#condpago_doc" ).focus();
        return;
     }

     if ( !$( "#tipod_doc-notacredito" ).val() ) {
        swal("Oops","' .Yii::t('documento', 'You must select a document type').'","error");
        $( "#tipod_doc-notacredito" ).parent().addClass("has-error");
        $( "#tipod_doc-notacredito" ).focus();
        return;
     }

    let band = false;
    $.each($("input[id$=\'check_ddetalle\']"), function(i, elem) {
      band = $( elem ).prop("checked");
      if ( band ) return false;
    });

    if (!band){
	  swal("Oops","' .Yii::t('documento', 'You must select at least one item!').'","error");
      return;
    }

     let $form = $( "#documento" ).contents().find("form");
     //console.log( $($form).serialize());
     $.ajax({
       url     : "' . Url::to(['nota-credito/create']) . '",
       data    : $( $form ).serialize(),
       async   : false,
       method  : "POST",
       success : function (data) {
          if ( data.success ) {
            //swal(data.title, data.message, data.type);

            $( "form#'.$model->formName().'" ).trigger( "reset" );
            selects = $("form#'.$model->formName().'").find("select");

            if ( selects.length ){
              selects.trigger( "change" );
            }

      			window.open(
      			  "'.Url::to(['nota-credito/nota-rpt']).'/" + data.id,
      			  "'. Yii::t('documento','Credit note').'",
      			  "toolbar=no," +
      			  "location=no," +
      			  "statusbar=no," +
      			  "menubar=no," +
      			  "resizable=0," +
      			  "width=800," +
      			  "height=600," +
      			  "left = 490," +
      			  "top=300");
      			swal(data.title, data.message, data.type);


            $( ".table-body" ).empty();
			      $( "#documento" ).css( "display", "none" );

            return;
          }
          if (data.message) {
		        return swal(data.title, data.message, data.type);
          } else {
		        return swal("Oops!", JSON.stringify(data), "error");
          }
       },
       error   : function (data) {
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
     })

   });
';

$this->registerJs($js,View::POS_END);
Yii::$app->view->registerJs('const IMPUESTO = '. $IMPUESTO .' / 100;',  \yii\web\View::POS_HEAD);
$this->registerCss(".detalle-item { padding: 5px 5px; }");
