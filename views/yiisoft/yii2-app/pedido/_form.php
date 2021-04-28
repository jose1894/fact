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
      <div class="col-lg-4 col-md-4">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
              Datos del cliente
            </h3>
          </div>
          <div class="box-body">
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <?= $form
                  ->field($model, 'cod_pedido',['addClass' => 'form-control input-sm'])
                  ->textInput(['maxlength' => true,'readonly' => true, 'style' => ['text-align' => 'right']]) ?>
                </div>

                <div class="col-sm-6 col-xs-12">
                  <?php
                    echo $form->field($model, 'fecha_pedido',[
                      'addClass' => 'form-control input-sm',
                    ])->textInput([
                          'value' => $model->fecha_pedido,
                          'readonly' => 'readonly',
                          'style' => ['text-align' => 'right'],
                          'disabled' => $disabled,
                      ]) ?>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <?php
                  $url = Url::to(['cliente/cliente-list']);
                  $cliente = empty($model->clte_pedido) ? '' : Cliente::findOne($model->clte_pedido)->nombre_clte;
                  echo $form->field($model, 'clte_pedido',[
                    'addClass' => 'form-control input-sm',
                    'hintType' => ActiveField::HINT_SPECIAL
                    ])->widget(Select2::classname(), [
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
                      'initValueText' => $cliente, // set the initial display text
                      'options' => ['placeholder' => Yii::t('cliente','Select a customer').'...'],
                      'size' => 'sm',
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
                <div class="col-xs-12">
                  <label for=""><?= Yii::t('cliente','Address') ?></label>
                  <?= Html::textArea('pedido',"",[
                    'id'=>'pedido-direccion_pedido',
                    'class' => 'form-control input-sm',
                    'rows' => 1,
                    'readonly' => true
                  ]); ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 col-xs-12">
                  <?php
                    $list = ['NP' => 'PEDIDO', 'PR' => 'PROFORMA', 'CT' => 'COTIZACION'];
                  ?>
                  <?= $form->field($model, 'tipo_pedido',[
                      'addClass' => 'form-control',
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]
                    ])->dropDownList( $list,
                      ['custom' => true, 'class' => 'input-sm', 'prompt' => Yii::t('app','Select...'), 'disabled' => $disabled]
                      ) ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <?php
                  $vendedor = empty($model->vend_pedido) ? '' : Vendedor::findOne($model->vend_pedido)->nombre_vend;
                  $vendedores = Vendedor::getVendedoresList();
                  ?>
                  <?= $form->field($model, 'vend_pedido',[
                    'addClass' => 'form-control',
                    ])->widget(Select2::classname(), [
                              'data' => $vendedores,
                              'size' => 'sm',
                              'initValueText' => $vendedor,
                              'language' => Yii::$app->language,
                              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
                              'options' => [
                                'placeholder' => '',
                              ],
                      ])?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <?php
                  $condiciones = CondPago::getCondPagoList();
                  ?>
                  <?= $form->field($model, 'condp_pedido',[
                    'addClass' => 'form-control input-sm',
                    ])->widget(Select2::classname(), [
                              'data' => $condiciones,
                              'size' => 'sm',
                              'language' => Yii::$app->language,
                              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                              'options' => [
                                'placeholder' => '',
                              ],
                      ])?>
                      <?php
                        echo Html::activeHiddenInput($model, "usuario_pedido");
                      ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 col-xs-12">
                  <?= $form->field($model, 'nrodoc_pedido',['addClass' => 'form-control '])->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <?php
                    $almacenes = Almacen::getAlmacenList();
                  ?>
                  <?= $form->field($model, 'almacen_pedido',[
                    'addClass' => 'form-control',
                    ])->widget(Select2::classname(), [
                              'data' => $almacenes,
                              'size' => 'sm',
                              'language' => Yii::$app->language,
                              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-archive"></i>']],
                              'options' => ['placeholder' => Yii::t('almacen',''), 'class' => 'input-sm'],
                              'disabled' => $disabled,
                      ])?>
                </div>
                <div class="col-sm-4 col-xs-12">
                  <?php
                    $monedas = Moneda::getMonedasList();
                  ?>
                  <?= $form->field($model, 'moneda_pedido',[
                  'addClass' => 'form-control input-sm',
                    ])->widget(Select2::classname(), [
                              'data' => $monedas,
                              'size' => 'sm',
                              'language' => Yii::$app->language,
                              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-money"></i>']],
                              'options' => ['placeholder' => '', 'class' => 'input-sm'],
                              'disabled' => $disabled
                      ])?>
                </div>
              </div>
              <div class="row">
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
                    <td class="col-xs-3" style="text-align:right;">
                      <?= Yii::t('app', 'Discount') ?>
                    </td>
                    <td class="col-xs-3">
                      <input type="text" id="descuento" name="descuento" readonly class="form-control input-sm  totales" value="">
                    </td>
                  </tr>
                  <tr>
                    <td class="col-xs-3" style="text-align:right;">
                      <?= Yii::t('app', 'Subtotal') ?>
                    </td>
                    <td class="col-xs-3">
                      <input type="text" id="subtotal2" name="subtotal" readonly class="form-control input-sm  totales" value="">
                    </td>
                  </tr>
                  <tr>
                    <td class="col-xs-3" style="text-align:right;">
                      <?= Yii::t('app', 'Tax')?> <?= $IMPUESTO ?>%
                    </td>
                    <td class="col-xs-3">
                      <input type="text" name="impuesto" id="impuesto" readonly class="form-control input-sm  totales" value="">
                    </td>
                  </tr>
                  <tr>
                    <td class="col-xs-3" style="text-align:right;">
                      <?= Yii::t('app', 'Total')?>
                    </td>
                    <td class="col-xs-3">
                      <input type="text" name="total" id="total" readonly  class="form-control input-sm  totales" value="">
                    </td>
                  </tr>
                </table>
              </div>
              <div class="form-group" style="float:right">
                <?php if ( !$model->isNewRecord ) { ?>
                  <button type="button" name="button" id="imprimir" data-toggle="modal" class="btn btn-flat btn-primary "><span class="fa fa-print"></span> <?= Yii::t('app', 'Print')?></button>
                <?php } ?>
                <button id="submit" type="button" class="btn btn-flat btn-success"><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
              </div>
            </div>
          </div>
      </div>
      <div class="col-lg-8 col-md-8">
        <!-- Articulos -->
        <div class="row">
          <div class="container-fluid">
              <div class="row">
                <div class="row" style="padding:15px">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                      <label for="select-producto"><?= Yii::t('producto', 'Product')?></label>
                      <?= Select2::widget( [
                            'name' => 'select-product',
                            'data' => Producto::getProductoList(),
                            'size' => 'sm',
                            'initValueText' => null,
                            'language' => Yii::$app->language,
                            'options' => [
                            				'allowClear' => true,
                            				'placeholder' => Yii::t('producto','Select a product').'...',
                                    'id' => 'select-producto',
                            ],
                      			'changeOnReset' => true,
                    ]) ?>
                    <?=  Html::hiddenInput('prod_pdetalle', $IMPUESTO,['id'=> 'impuesto-prod']); ?>
                  </div>
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <label for="stock"><?= Yii::t('pedido', 'Stock')?></label>
                    <?= Html::input('text','stock','', $options=['class'=>'form-control input-sm  number-integer', 'id' => 'stock-prod', 'maxlength'=>5, 'readonly' => true, 'pattern' => '[0-9]*\.?[0-9]*']) ?>
                  </div>
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <label for="cantidad"><?= Yii::t('pedido', 'Qtty')?></label>
                    <?= Html::input('text','cantidad','', $options=['class'=>'form-control input-sm number-integer', 'id' => 'cantidad-prod', 'maxlength'=>5, 'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
                  </div>
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <label for="plista"><?= Yii::t('pedido', 'P. Lista')?></label>
                    <?= Html::input('text','plista','', $options=['class'=>'form-control input-sm number-integer', 'id' => 'plista-prod', 'readonly' => true, 'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
                  </div>
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <label for="descuento"><?= Yii::t('pedido', 'Disc')?></label>
                    <?= Html::input('text','descuento','', $options=['class'=>'form-control input-sm number-decimals', 'id' => 'descuento-prod',  'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
                  </div>
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <label for="precio"><?= Yii::t('pedido', 'Price')?></label>
                    <?= Html::input('text','precio','', $options=['class'=>'form-control input-sm number-decimals', 'id' => 'precio-prod',  'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-1 col-xs-12">
                    <label for="total"><?= Yii::t('pedido', 'Total')?></label>
                    <?= Html::input('text','total','', $options=['class'=>'form-control input-sm number-integer', 'id' => 'total-prod',  'readonly' => true,'autocomplete' => 'off', 'pattern' => '[0-9]*\.?[0-9]*']) ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-offset-8 col-xs-4 text-right">
                    <button type="button" class="btn btn-flat btn-primary" id="btn-agregar" disabled>Agregar</button>
                  </div>

                </div>
              </div>
              <hr>
              <div class="row">
                  <div class="col-sm-1 col-xs-12">#</div>
                  <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Qtty')?></div>
                  <div class="col-sm-7 col-xs-12"><?= Yii::t( 'pedido', 'Product')?></div>
                  <!-- <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'L. price')?></div> -->
                  <!--th class="col-xs-1"><?= Yii::t( 'pedido', 'Tax')?></th-->
                  <!-- <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Disc.')?></div> -->
                  <!-- <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Price')?></div> -->
                  <div class="col-sm-2 col-xs-12"><?= Yii::t( 'pedido', 'Total')?></div>
                  <div class="col-sm-1 col-xs-12">
                    <!-- <button type="button" class="add-item btn btn-success btn-flat btn-md" style="width:100%"  data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Add item')?>"><i class="fa fa-plus"></i></button> -->
                  </div>
              </div>
              <hr>
              <div class="table-body"><!-- widgetContainer -->
                <?php
                if (!$model->isNewRecord) {
                foreach ($modelsDetalles as $index => $modelDetalle): ?>
                        <div class="row detalle-item"><!-- widgetBody -->
                          <div class="col-sm-1 col-xs-12">
                            <span class="nro"><?= ( $index + 1 ) ?></span>
                            <?=  Html::hiddenInput('PedidoDetalle['.$index.'][prod_pdetalle]', $modelDetalle->prod_pdetalle,['id'=> 'pedidodetalle-'.$index.'-prod_pdetalle']); ?>
                          </div>
                          <div class="col-sm-1 col-xs-12">
                            <?= Html::input(
                                  'text','PedidoDetalle['.$index.'][cant_pdetalle]',
                                  $modelDetalle->cant_pdetalle,
                                  $options=['class'=>'form-control input-sm number-integer', 'id' => 'pedidodetalle-'.$index.'-cant_pdetalle', 'maxlength'=>5, 'readonly' => true, 'pattern' => '[0-9]*\.?[0-9]*']
                            ) ?>
                            <?=  Html::hiddenInput('PedidoDetalle['.$index.'][plista_pdetalle]', $modelDetalle->plista_pdetalle,['id'=> 'pedidodetalle-'.$index.'-plista_pdetalle']); ?>
                            <?=  Html::hiddenInput('PedidoDetalle['.$index.'][descu_pdetalle]', $modelDetalle->descu_pdetalle,['id'=> 'pedidodetalle-'.$index.'-descu_pdetalle']); ?>
                            <?=  Html::hiddenInput('PedidoDetalle['.$index.'][precio_pdetalle]', $modelDetalle->precio_pdetalle,['id'=> 'pedidodetalle-'.$index.'-precio_pdetalle']); ?>
                            <?=  Html::hiddenInput('PedidoDetalle['.$index.'][impuesto_pdetalle]', $modelDetalle->impuesto_pdetalle,['id'=> 'pedidodetalle-'.$index.'-impuesto_pdetalle']); ?>
                          </div>
                          <div class="col-sm-7 col-xs-12">
                            <?= Html::input(
                              'text',
                              'PedidoDetalle['.$index.'][desc_pdetalle]',
                              trim($modelDetalle->productoPdetalle->cod_prod.'-'.$modelDetalle->productoPdetalle->des_prod),
                              $options=['class'=>'form-control input-sm',
                              'id' => 'pedidodetalle-' .$index. '-desc_pdetalle' ,
                              'readonly' => true,]) ?>
                            </div>
                          <!-- <div class="col-sm-1 col-xs-12">
                            <?php /* Html::input(
                                  'text','PedidoDetalle['.$index.'][plista_pdetalle]',
                                  $modelDetalle->plista_pdetalle,
                                  $options=['class'=>'form-control number-integer', 'id' => 'pedidodetalle-'.$index.'-plista_pdetalle', 'maxlength'=>5, 'readonly' => true, 'pattern' => '[0-9]*\.?[0-9]*']
                            ) */ ?>
                          </div> -->
                          <!-- <div class="col-sm-1 col-xs-12">
                            <?php /* Html::input(
                                  'text','PedidoDetalle['.$index.'][descu_pdetalle]',
                                  $modelDetalle->descu_pdetalle,
                                  $options=['class'=>'form-control number-integer', 'id' => 'pedidodetalle-'.$index.'-descu_pdetalle', 'maxlength'=>5, 'readonly' => true, 'pattern' => '[0-9]*\.?[0-9]*']
                            )*/ ?>
                          </div> -->
                          <!-- <div class="col-sm-1 col-xs-12">
                            <?php /* Html::input(
                                  'text','PedidoDetalle['.$index.'][precio_pdetalle]',
                                  $modelDetalle->precio_pdetalle,
                                  $options=['class'=>'form-control number-integer', 'id' => 'pedidodetalle-'.$index.'-precio_pdetalle', 'maxlength'=>5, 'readonly' => true, 'pattern' => '[0-9]*\.?[0-9]*']
                            ) */ ?>
                          </div> -->
                          <div class="col-sm-2 col-xs-12">
                            <?= Html::input(
                                  'text','PedidoDetalle['.$index.'][total_pdetalle]',
                                  $modelDetalle->total_pdetalle,
                                  $options=['class'=>'form-control input-sm number-integer', 'id' => 'pedidodetalle-'.$index.'-total_pdetalle', 'maxlength'=>5, 'readonly' => true, 'pattern' => '[0-9]*\.?[0-9]*']
                            ) ?>
                          </div>
                          <div class="col-sm-1 col-xs-12">
                            <!-- <button type="button" class="remove-item btn btn-primary btn-flat btn-sm" data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Edit item')?>"><i class="fa fa-pencil"></i></button> -->
                            <button type="button" class="remove-item btn btn-danger btn-flat btn-sm" data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Delete item')?>"><i class="fa fa-trash"></i></button>
                        </div>
                      </div>
                <?php endforeach;
              }?>
              </div>
            <div class="row">
                  <div class="col-sm-11 col-xs-12"></div>
                  <div class="col-sm-1 col-xs-12">
                    <!-- <button type="button" class="add-item btn btn-success btn-flat btn-md" style="width:100%"  data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Add item')?>"><i class="fa fa-plus"></i></button> -->
                  </div>
            </div>
            <hr>
          </div>
        </div>
        <!-- Articulos -->
      </div>
      <?php ActiveForm::end(); ?>
    </div>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
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
const URI_PRINT_NEW = '".Url::to(['pedido/pedido-rpt'])."/';
const URI_CLIENTE = '". Url::to(['cliente/cliente-list'])."';
const DISC_LIMIT_MESSG = '" . Yii::t( 'pedido', 'The amount discount is greather than 10%'). "';
const BTN_EDIT = '" . Yii::t('app','Edit item') ."';
const BTN_DELETE = '" . Yii::t('app','Delete item') ."';
const BTN_ADD = '" . Yii::t('producto','Please select a valid product! Check its price and quantity!') ."';
const MSG_SEND_TITLE = '".Yii::t('pedido','Do you want to issue the document?')."';
const MSG_TITLE =  '".Yii::t('pedido','Order')."';
const MSG_DETAIL_VALIDATION = '".Yii::t('pedido','The order must have at least one item to be saved')."';
", \yii\web\View::POS_HEAD);

$jsTrigger = "";

if ( !$model->isNewRecord ){
  $jsTrigger = "
    console.log('trigger');
    // $('.sidebar-toggle').trigger('click')
    $('#pedido-clte_pedido').trigger('change');
    calculateTotals( IMPUESTO );
  ";
}
$this->registerJs($jsTrigger,View::POS_LOAD);

$js = <<< JS
$('.sidebar-toggle').trigger('click')

$( "#btn-agregar" ).on( "click", function() {
  const LINE = $( '.table-body .row.detalle-item' ).length;
  const ID_LINE = LINE + 1;
  let codprod =  $( "#select-producto" ).val();
  let textProd =  $( "#select-producto option:selected" ).text().trim();
  let cant =  round($( "#cantidad-prod" ).val());
  let descuento = !+($( "#descuento-prod" ).val()) ? 0 : +($( "#descuento-prod" ).val());
  let precio = $( "#precio-prod" ).val();
  let impuesto = $( "#impuesto-prod" ).val();
  let precioLista = $( "#plista-prod" ).val();
  let total = $( "#total-prod" ).val();

  if ( !total || !precioLista || !precio || !cant || !codprod) {
    swal('Oops!', BTN_ADD, 'danger')
    return
  }

  const ROW = `
    <div class="row detalle-item"><!-- widgetBody -->
        <div class="col-sm-1 col-xs-12">
          <span class="nro">` + ID_LINE + `</span>
          <input type="hidden" id="pedidodetalle-` + LINE + `-prod_pdetalle" name="PedidoDetalle[` + LINE + `][prod_pdetalle]" value="` + codprod + `">
        </div>
        <div class="col-sm-1 col-xs-12">
          <input type="text" id="pedidodetalle-` + LINE + `-cant_pdetalle" class="form-control input-sm number-integer" name="PedidoDetalle[` + LINE + `][cant_pdetalle]" value="` + cant + `" readonly="" maxlength="5" pattern="[0-9]*\.?[0-9]*">
          <input type="hidden" id="pedidodetalle-` + LINE + `-plista_pdetalle" class="form-control number-integer" name="PedidoDetalle[` + LINE + `][plista_pdetalle]" value="` + precioLista + `" readonly="" maxlength="5" pattern="[0-9]*\.?[0-9]*">
          <input type="hidden" id="pedidodetalle-` + LINE + `-descu_pdetalle" class="form-control number-integer" name="PedidoDetalle[` + LINE + `][descu_pdetalle]" value="` + descuento + `" readonly="" maxlength="5" pattern="[0-9]*\.?[0-9]*">
          <input type="hidden" id="pedidodetalle-` + LINE + `-precio_pdetalle" class="form-control number-integer" name="PedidoDetalle[` + LINE + `][precio_pdetalle]" value="` + precio + `" readonly="" maxlength="5" pattern="[0-9]*\.?[0-9]*">
          <input type="hidden" id="pedidodetalle-` + LINE + `-impuesto_pdetalle" class="form-control number-integer" name="PedidoDetalle[` + LINE + `][impuesto_pdetalle]" value="` + impuesto + `" readonly="" maxlength="5" pattern="[0-9]*\.?[0-9]*">
        </div>
        <div class="col-sm-7 col-xs-12">
          <input type="text" id="pedidodetalle-` + LINE + `-desc_pdetalle" class="form-control input-sm" name="PedidoDetalle[` + LINE + `][desc_pdetalle]" value="` + textProd + `" readonly>
        </div>
        <div class="col-sm-2 col-xs-12">
          <input type="text" id="pedidodetalle-` + LINE + `-total_pdetalle" class="form-control input-sm number-integer" name="PedidoDetalle[` + LINE + `][total_pdetalle]" value="` + total + `" readonly="" maxlength="5" pattern="[0-9]*\.?[0-9]*">
        </div>
        <div class="col-sm-1 col-xs-12">
          <button type="button" class="remove-item btn btn-danger btn-flat btn-sm" data-toggle="tooltip" data-placement="top" title="Delete item"><i class="fa fa-trash"></i></button>
        </div>
    </div>`;

  $( ".table-body" ).append(ROW);
  $( "#cantidad-prod" ).val("");
  $( "#descuento-prod" ).val("");
  $( "#precio-prod" ).val("");
  $( "#plista-prod" ).val("");
  $( "#stock-prod" ).val("");
  $( "#total-prod" ).val("");
  $( "#select-producto").val(null).trigger('change');
  $( "#select-producto").focus();
  $( "#btn-agregar").prop('disabled',true);
  calculateTotals( IMPUESTO );
});

$( 'body' ).on('click', '.remove-item', function () {
    $( this ).parent().parent().remove();

    $.each( $('.detalle-item'), function(index, value){
        $(value).find('.nro').text(index + 1)
        $(value).find('input[id$="prod_pdetalle"]').prop('id','pedidodetalle-' + index + '-prod_pdetalle')
        $(value).find('input[id$="cant_pdetalle"]').prop('id','pedidodetalle-' + index + '-cant_pdetalle')
        $(value).find('input[id$="plista_pdetalle"]').prop('id','pedidodetalle-' + index + '-plista_pdetalle')
        $(value).find('input[id$="descu_pdetalle"]').prop('id','pedidodetalle-' + index + '-descu_pdetalle')
        $(value).find('input[id$="precio_pdetalle"]').prop('id','pedidodetalle-' + index + '-precio_pdetalle')
        $(value).find('input[id$="impuesto_pdetalle"]').prop('id','pedidodetalle-' + index + '-impuesto_pdetalle')
        $(value).find('input[id$="total_pdetalle"]').prop('id','pedidodetalle-' + index + '-total_pdetalle')

    })

    calculateTotals( IMPUESTO );
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

$( '#cantidad-prod' ).on('keyup', function (e) {

  if ( e.keyCode === 13 && +$( this ).val() && +$('#select-producto').val() )  {
      $( "#descuento-prod").focus();
      return
  }

  if ( +$('#select-producto').val() ) {
    let cant = +$(this).val();
    let total = 0;

    if ( cant ) {
      let desc = +$('#descuento-prod').val();
      let precioLista = +$('#plista-prod').val();
      total = calcular(cant, desc, precioLista);
    }

    $("#precio-prod").val(total.precio)
    $("#total-prod").val(total.total)
  }
})

$( '#cantidad-prod' ).on('blur', function (e) {
  $( this ).trigger('keyup')
})

$( '#descuento-prod' ).on('keyup', function (e) {

  if ( e.keyCode === 13 && +$('#select-producto').val() && +$('#cantidad-prod').val() )  {
      $( "#precio-prod").focus();
      return
  }

  if ( +$('#select-producto').val() && +$('#cantidad-prod').val() ) {
    let cant = +$( "#cantidad-prod" ).val();
    let desc = +$( this ).val();
    let total = 0;
    let precioLista = +$('#plista-prod').val();

    total = calcular(cant, desc, precioLista);

    $("#precio-prod").val(total.precio)
    $("#total-prod").val(total.total)
  }

})

$( '#descuento-prod' ).on('blur', function (e) {
    $( this ).trigger( 'keyup' )

    let precio = $("#precio-prod").val()

    $("#precio-prod").val( round(precio) )

    discountLimit( +$( this ).val() )
})

$( '#precio-prod' ).on('keyup', function (e) {
  if ( e.keyCode === 13 && +$( this ).val()
      && +$('#select-producto').val() && +$('#cantidad-prod').val() )  {
      return
  }

  if ( +$('#select-producto').val() ) {
    let cant = +$( "#cantidad-prod" ).val();
    let total = 0;
    let precio

    if ( cant ) {
      let precioLista = +$('#plista-prod').val();
      let precio = +$( this ).val()

      total = calcular(cant, 0, precio);

      let descu = ((precio * 100) / precioLista);
      descu = 100 - descu;

      if ( 0 > descu ) {
        descu = 0;
      }

      $( "#descuento-prod" ).val( round( descu ) );
      $("#total-prod").val(total.total)
    }
  }
})

$( '#precio-prod' ).on('blur', function (e) {

  discountLimit( +$("#descuento-prod").val() )

   $( this ).val( round($(this).val()) )

});

$( '#submit' ).on( 'click', function() {
  let form = $( 'form#Pedido' );

  let rows = $('.table-body > .detalle-item').length;

  if ( !rows ) {
    swal(MSG_TITLE, MSG_DETAIL_VALIDATION, 'info');
    return false;
  }

  $.ajax( {
    'url'    : $( form ).attr( 'action' ),
    'method' : $( form ).attr( 'method' ),
    'data'   : $( form ).serialize(),
    'async'  : false,
    'success': function ( data ) {
      if ( data.success ) {
        if ( $( form ).attr('action').indexOf('create') != -1) {
          $( form ).trigger( 'reset' );
          selects = $(form).find('select');

          if ( selects.length ){
            selects.trigger( 'change' );
          }

          swal({
            title: MSG_SEND_TITLE,
            icon: 'info',
            buttons: true,
            dangerMode: true,
          })
          .then((willIssue) => {
            if (willIssue) {
              window.open(
                URI_PRINT_NEW + data.id,
                MSG_TITLE,
                'toolbar=no,' +
                'location=no,' +
                'statusbar=no,' +
                'menubar=no,' +
                'resizable=0,' +
                'width=800,' +
                'height=600,' +
                'left = 490,' +
                'top=300');
              swal(data.title, data.message, data.type);
            }
          });

          $( '.table-body' ).empty();

          return;
        }

        if ( data.codigo ) {
          $( '#pedido-cod_pedido' ).val( data.codigo );
        }

        swal(data.title, data.message, data.type);

        return;
      } else {
        $( form ).yiiActiveForm( 'updateMessages', data);
      }

    },
    error: function(data) {
        let message;

        if ( data.responseJSON ) {
          let error = data.responseJSON;
          message =   'Se ha encontrado un error: ' +
          '\\n\\nCode ' + error.code +
          '\\n\\nFile: ' + error.file +
          '\\n\\nLine: ' + error.line +
          '\\n\\nName: ' + error.name +
          '\\n Message: ' + error.message;
        } else {
            message = data.responseText;
        }

        swal('Oops!!!',message,'error' );
    }
  });


});

$( '#select-producto').on('select2:select', function(){
  let _currSelect = $( this );
  // let row = $( this ).attr( "id" ).split( "-" );
  // row = row[ 1 ];
  row = 99;

  let selects = $("input[id$='prod_pdetalle']");

  if ( checkDuplicate( _currSelect, row, selects) ) {
    _currSelect.val( null ).trigger( 'change' );
    swal( 'Oops!!!',"El código no puede repetirse, ya está en la lista","error" );
    _currSelect.focus();
  }

  let valor = parseInt( _currSelect.val() );
  const tipoLista = +$( "#pedido-tipo_listap" ).val();
  // const valor = $(this).val();

  if ( valor ) {
    $( "#cantidad-prod" ).focus();
    $( "#cantidad-prod" ).val("");
    $( "#stock-prod" ).val("");
    $( "#descuento-prod" ).val("");
    $( "#precio-prod" ).val("");
    $( "#total-prod" ).val("");
    $( "#impuesto-prod" ).val("");
    setPrices( valor, tipoLista);
    $("#btn-agregar").prop("disabled", false)
  }
});

function discountLimit( desc = 0) {
  if ( desc > 10 ) {
    swal( 'Oops!', DISC_LIMIT_MESSG , 'error');
  }
}

function calcular(cant = 0, descuento = 0, precioLista = 0) {
  let total = 0
  let precioVenta = precioLista

  total = cant * precioLista

  if ( descuento ) {
    precioVenta = precioLista - ( precioLista * ( descuento / 100 ) );
    total = ( cant *  precioVenta );
    descuento = ( precioLista * ( descuento / 100 ) );
  }

  return {'total': round(total) , 'precio' : round(precioVenta)}
}

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

            $( '#stock-prod' ).val( +data.results[ 0 ].stock);

            $( '#plista-prod' ).val( precioLista );
            $( '#impuesto-prod' ).val( impuestoDetalle );

            let descuDetalle = $( '#descuento-prod' ).val( );
            descuDetalle = descuDetalle ? descuDetalle : 0;
            $( '#precio-prod' ).val( descuDetalle );
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
    total += +$( '#pedidodetalle-' + i + '-total_pdetalle' ).val();
    subT = $( '#pedidodetalle-' + i + '-plista_pdetalle' ).val()  *  $( '#pedidodetalle-' + i + '-cant_pdetalle' ).val() / ( IMPUESTO + 1 ) ;
    desc = parseFloat( $( '#pedidodetalle-' + i + '-descu_pdetalle' ).val(  ) * $( '#pedidodetalle-' + i + '-cant_pdetalle' ).val()   / ( IMPUESTO + 1 ) );
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
