<?php

use app\models\TipoDocumento;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Documento;
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
                  <label for="tipo_doc"><?= Yii::t('documento','Document type')?></label>
                  <?= Html::dropDownList(
                          'tipo_doc',
                          null,
                          ArrayHelper::map(
                                  Numeracion::find()
                                      ->select(['id_num','concat(td.abrv_tipod,"/",serie_num," - ",td.des_tipod) numero_num'])
                                      ->joinWith(['tipoDocumento td'])
                                      ->where([
                                              'td.id_tipod' => [Documento::TIPODOC_FACTURA,Documento::TIPODOC_BOLETA ]
                                      ])
                                      ->orderBy('td.abrv_tipod asc,serie_num asc')->all(), 'id_num', 'numero_num'),
                          [
                                  'prompt' => Yii::t('app','Select'),
                                  'class' => 'form-control',
                                  'id' => 'tipo_doc'
                          ]
                      ) ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="num_doc"><?= Yii::t('documento','Code')?></label>
                <?= Html::input('text', 'cod_doc', '', ['id' => 'cod_doc','class' => 'form-control', 'style' => ['text-align' => 'right'], 'maxlength' => 10])  ?>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label></label>
                <button id="search"  class="btn btn-flat btn-success" style="width:100%"><?= Yii::t('app','Search');?>&nbsp; &nbsp;<i class="fa fa-search"></i></button>
            </div>

        </div>
    </div>
</div>

<div id="documento" style="display:block;">
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

              <?php $form = ActiveForm::begin([ 'enableClientScript' => true]); ?>
              <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="nota_credito-tipo_doc"><?= Yii::t('documento','Type')?></label>
                    <?= Html::input('text', 'NotaCredito[tipo_doc]', '', [
                                                                          'id'       => 'nota_credito-tipo_doc',
                                                                          'class'    => 'form-control',
                                                                          'maxlength' => 2,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                  </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                  <div class="form-group">
                    <label class="control-label" for="nota_credito-serie_doc"><?= Yii::t('documento','Serie')?></label>
                    <?= Html::input('text', 'NotaCredito[serie_doc]', '', [
                                                                          'id'       => 'nota_credito-serie_doc',
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
                    <label class="control-label" for="nota_credito-cod_doc"><?= Yii::t('documento','Code')?></label>
                    <?= Html::input('text', 'NotaCredito[cod_doc]', '', [
                                                                          'id'        => 'nota_credito-cod_doc',
                                                                          'class'     => 'form-control',
                                                                          'style'     => [
                                                                                        'text-align' => 'right'
                                                                                      ],
                                                                          'maxlength' => 10,
                                                                          'readonly'  => true,
                                                                        ])  ?>
                  </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <!-- Fecha documento -->
                  <div class="form-group">
                    <label class="control-label" for="nota_credito-fecha_doc"><?= Yii::t('documento','Date')?></label>
                    <?= Html::input('text', 'NotaCredito[fecha_doc]', '', [
                                                                          'id'        => 'nota_credito-fecha_doc',
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
                                                                        'id'        => 'nota_credito-nombre_cliente',
                                                                        'class'     => 'form-control',
                                                                        'maxlength' => 10,
                                                                        'readonly'  => true,
                                                                      ])  ?>
                  <!-- lista Precios -->
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <label for=""><?= Yii::t('cliente','Address') ?></label>
                  <!-- Direccion -->
                  <?= Html::textarea('NotaCredito[direcc_cliente]', '', [
                                                                        'id'        => 'nota_credito-direcc_cliente',
                                                                        'class'     => 'form-control',
                                                                        'maxlength' => 10,
                                                                        'readonly'  => true,
                                                                      ])  ?>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <!-- Moneda -->
                  <label class="control-label" for="nota_credito-nombre_cliente"><?= Yii::t('moneda','Currency')?></label>
                  <?= Html::input('text', 'NotaCredito[moneda_pedido]', '', [
                    'id'        => 'nota_credito-moneda_pedido',
                    'class'     => 'form-control',
                    'maxlength' => 10,
                    'readonly'  => true,
                    ])  ?>
                  </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label class="control-label" for="nota_credito-motivo_doc"><?= Yii::t('cliente','Motivo')?></label>
                  <?= Html::dropDownList('NotaCredito[motivo_doc]', null,[
                                                              '00' => 'Seleccione',
                                                              '01' =>	'Anulación de la operación',
                                                              '02' =>	'Anulación por error en el RUC',
                                                              '03' =>	'Corrección por error en la descripción',
                                                              '04' =>	'Descuento global',
                                                              '05' =>	'Descuento por ítem',
                                                              '06' =>	'Devolución total',
                                                              '07' =>	'Devolución por ítem',
                                                              '08' =>	'Bonificación',
                                                              '09' =>	'Disminución en el valor',
                                                              '10' =>	'Otros Conceptos ',
                                                              '11' =>	'Ajustes de operaciones de exportación',
                                                              '12' =>	'Ajustes afectos al IVAP'
                                                            ],
                                                            [
                                                              'class' => 'form-control',
                                                              'id'    => 'nota_credito-motivo_doc'
                                                            ]
                                                            ) ?>
                </div>
              </div>


              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <!-- Almacen -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <!-- Condicion de pago -->
                </div>
              </div>
              <?php /*
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
                        <div class="col-sm-5 col-xs-12"><?= Yii::t( 'pedido', 'Product')?></div>
                        <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Qtty')?></div>
                        <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'L. price')?></div>
                        <!--th class="col-xs-1"><?= Yii::t( 'pedido', 'Tax')?></th-->
                        <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Disc.')?></div>
                        <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Price')?></div>
                        <div class="col-sm-2 col-xs-12"><?= Yii::t( 'pedido', 'Total')?></div>
                        <div class="col-sm-1 col-xs-12">
                          <button type="button" class="add-item btn btn-success btn-flat btn-md" style="width:100%"  data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Add item')?>"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-body"><!-- widgetContainer -->
                    <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
                            <div class="row detalle-item"><!-- widgetBody -->
                              <div class="col-sm-5 col-xs-12">
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
                                ?>

                              </div>
                              <div class="col-sm-1 col-xs-12">
                                <?= $form
                                ->field($modelDetalle,"[{$index}]cant_pdetalle",[ 'addClass' => 'form-control number-integer'])
                                ->textInput(['type' => 'text'])
                                ->label(false)?>
                              </div>
                              <div class="col-sm-1 col-xs-12">
                                <?= $form
                                ->field($modelDetalle,"[{$index}]plista_pdetalle", [ 'addClass' => 'form-control number-decimals'])
                                ->textInput([ 'type' => 'text','readonly' => true])
                                ->label(false)?>
                              </div>
                              <!--div class="col-xs-1 col-xs-12">
                                <?= $form->field($modelDetalle,"[{$index}]impuesto_pdetalle")
                                ->textInput([
                                  'class' => 'form-control ',
                                  'style' => ['text-align' => 'right'],
                                  'readonly' => true,
                                ])->label(false)?>
                              </div-->
                              <div class="col-sm-1 col-xs-12">
                                <?= $form
                                ->field($modelDetalle,"[{$index}]descu_pdetalle", [ 'addClass' => 'form-control number-decimals'])
                                ->textInput([ 'type'=>'text','width' => '200px'])
                                ->label(false)?>
                              </div>
                              <div class="col-sm-1 col-xs-12">
                                <?= $form
                                ->field($modelDetalle,"[{$index}]precio_pdetalle",[ 'addClass' => 'form-control number-decimals'])
                                ->textInput(['type'=>'text','width' => '200px'])
                                ->label(false)?>
                              </div>
                              <div class="col-sm-2 col-xs-12">
                                <?= $form
                                ->field($modelDetalle,"[{$index}]total_pdetalle",[ 'addClass' => 'form-control number-decimals'])
                                ->textInput(['type'=>'text','readonly' => true])
                                ->label(false)?>
                              </div>
                              <div class="col-sm-1 col-xs-12">
                                <button type="button" class="remove-item btn btn-danger btn-flat btn-sm" style="width:100%" data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Delete item')?>"><i class="fa fa-trash"></i></button>
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
    </div>
  </div>
</div>

<?php

$js = '

   $( "#cod_doc" ).on( "blur", function() {
     let value = $(this).val();

     if ( value && !isNaN( value ) ) {
        return $( this ).val( value.padStart( 10, "0") );
     }

     return $( this ).val();
   });

   $( "#search" ).on( "click", function() {
     $("#tipo_doc").parent().removeClass("has-error");
     $("#cod_doc").parent().removeClass("has-error");


     if ( !$("#tipo_doc").val() ) {
        swal("Error","Oops, debe seleccionar un tipo de documento","error");
        $("#tipo_doc").parent().addClass("has-error");
        $("#tipo_doc").focus();
        return;
     }

     if ( !$("#cod_doc").val() ) {
        swal("Error","Oops, debe indicar el numero de documento","error");
        $("#cod_doc").parent().addClass("has-error");
        $("#cod_doc").focus();
        return;
     }

     $.ajax({
       url  : "'. Url::to(['documento/get-documento']).'",
       data : {
                tipo   : $("#tipo_doc").val(),
                numero : $("#cod_doc").val(),
              },
        success : function( data ) {
            buildForm( data );
        },
        error   : function( data ) {
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
        }
     });
   });

   function buildForm( data ) {
      $( "#documento" ).css("display","block");
      for(opc in data) {
        $( "input[id$=\'" + opc + "\']" ).val( data[opc] );
        $( "textarea[id$=\'" + opc + "\']" ).val( data[opc] );
      }

   }
';

$this->registerJs($js,View::POS_END);
