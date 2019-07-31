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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?= $form->field($model, 'nrodoc_compra',[
              'addClass' => 'form-control'
            ])->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <!-- Articulos -->
    <div class="row">
      <div class="col-lg-12">
        <?php  DynamicFormWidget::begin([
              'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
              'widgetBody' => '.detalle-body', // required: css class selector
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
            <div class="col-xs-5">
              <h5>Producto</H5>
            </div>
            <div class="col-xs-2">
              <h5>Cantidad</h5>
            </div>
            <div class="col-xs-1">
              <h5>Descuento</h5>
            </div>
            <div class="col-xs-1">
              <h5>Precio</h5>
            </div>
            <div class="col-xs-2">
              <h5>Total</h5>
            </div>
            <div class="col-xs-1">
              <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="detalle-body">
            <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
              <div class="detalle-item">
                <div class="col-sm-5">
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
                <div class="col-sm-2">
                  <?= $form
                  ->field($modelDetalle,"[{$index}]cant_cdetalle",[ 'addClass' => 'form-control number-decimals'])
                  ->textInput(['type' => 'number','min' => 0, 'step' => 1])
                  ->label(false)?>
                </div>
                <div class="col-sm-1">
                  <?= $form
                  ->field($modelDetalle,"[{$index}]precio_cdetalle",[ 'addClass' => 'form-control number-decimals'])
                  ->textInput(['type' => 'number','min' => 0, 'step' => 1])
                  ->label(false)?>
                </div>
                <div class="col-sm-1">
                  <?= $form
                  ->field($modelDetalle,"[{$index}]descu_cdetalle",[ 'addClass' => 'form-control number-decimals'])
                  ->textInput(['type' => 'number','min' => 0, 'step' => 1])
                  ->label(false)?>
                </div>
                <div class="col-sm-2">
                  <?= $form
                  ->field($modelDetalle,"[{$index}]total_cdetalle",[ 'addClass' => 'form-control number-decimals'])
                  ->textInput(['type' => 'number','min' => 0, 'step' => 1])
                  ->label(false)?>
                </div>
                <div class="col-sm-1">
                  <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                  <div class="clearfix"></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php DynamicFormWidget::end(); ?>
      </div>
    </div>
    <!-- Articulos -->



    <div class="form-group">
        <?= Html::submitButton(Yii::t('compra', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
<?php
$this->registerJsFile(Yii::$app->getUrlManager()->getBaseUrl().'/js/dynamicform.js',
['depends'=>[\yii\web\JqueryAsset::className()],
'position'=>View::POS_END]);
