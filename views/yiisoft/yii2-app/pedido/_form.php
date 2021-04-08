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
                        <div class="col-sm-1 col-xs-12">
                          <?= $modelDetalle->cant_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                          <?= $modelDetalle->plista_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                          <?= $modelDetalle->descu_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                          <?= $modelDetalle->precio_pdetalle ?>
                        </div>
                        <div class="col-sm-1 col-xs-12 text-right">
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

            <?= Select2::widget( [
                  'name' => 'select-product',
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->

<?php

Yii::$app->view->registerJs('const IMPUESTO = '. $IMPUESTO .' / 100;',  \yii\web\View::POS_HEAD);
$this->registerJs('
', \yii\web\View::POS_READY);
$js = <<< JS
$( 'body' ).on('click', '.add-item', function () {
  $( '#modal-producto' ).modal( {backdrop: 'static', keyboard: false} )
});

$("body").on("keyup.yiiGridView", "#table-producto .filters input", function(){
    $("#table-producto").yiiGridView("applyFilter");
})


$( '#select-producto').on('click', function(){
  let _currSelect = $( this );
  let row = $( this ).attr( "id" ).split( "-" );
  row = row[ 1 ];

  let selects = $("select[id$='prod_pdetalle']");

  if ( checkDuplicate( _currSelect, row, selects) ) {
    _currSelect.val( null ).trigger( 'change' );
    swal( 'Oops!!!',"El código no puede repetirse, ya está en la lista","error" );
    _currSelect.focus();
  }

  let valor = parseInt( _currSelect.val() );
  let tipoLista = parseInt( $( "#pedido-tipo_listap" ).val() );

  if ( valor ) {
    $( '#pedidodetalle-' + row + '-cant_pdetalle' ).focus();
    $( '#pedidodetalle-' + row + '-cant_pdetalle' ).val("");
    $( '#pedidodetalle-' + row + '-descu_pdetalle' ).val("");
    $( '#pedidodetalle-' + row + '-precio_pdetalle' ).val("");
    $( '#pedidodetalle-' + row + '-total_pdetalle' ).val("");
    setPrices( valor, row, tipoLista);
  }
});
JS;

$this->registerJs($js,View::POS_END);
