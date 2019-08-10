<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\models\TipoMovimiento;
use app\models\Almacen;
use yii\web\View ;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use app\base\Model;


/* @var $this yii\web\View */
/* @var $model app\models\NotaIngreso */
/* @var $form yii\widgets\ActiveForm */
if ( $model->isNewRecord ) {
  $model->codigo_trans = "0000000000";
}
?>

<div class="nota-ingreso-form">

  <div class="container-fluid">


        <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true]); ?>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form
            ->field($model, 'codigo_trans',['addClass' => 'form-control '])
            ->textInput(['maxlength' => true,'readonly' => true, 'style' => ['text-align' => 'rigth']]) ?>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <?= $form->field($model, 'fecha_trans',[
                  'addClass' => 'form-control'
              ])->textInput([
                'value' => date('d/m/Y'),
                'readonly' => 'readonly',
                'style' => ['text-align' => 'right']
                ]) ?>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?php
              $mov = TipoMovimiento::getTipoMovList( 'E' );
            ?>
            <?= $form->field($model, 'tipo_trans',[
                'addClass' => 'form-control'
              ])->widget(Select2::classname(), [
                        'data' => $mov,
                        'language' => Yii::$app->language,
                        'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-exchange"></i>']],
                        'options' => ['placeholder' => Yii::t('tipo_movimiento','Select a type').'...'],
                        'theme' => Select2::THEME_DEFAULT,
                        // 'pluginOptions' => [
                        //     'allowClear' => true
                        // ],
                ]) ?>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'docref_trans',[
                'addClass' => 'form-control'
              ])->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php $almacenes = Almacen::getAlmacenList();?>

            <?= $form->field($model, 'almacen_trans',[
                'addClass' => 'form-control'
              ])->widget(Select2::classname(), [
                        'data' => $almacenes,
                        'language' => Yii::$app->language,
                        'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-exchange"></i>']],
                        'options' => ['placeholder' => Yii::t('almacen','Select a warehouse').'...'],
                        'theme' => Select2::THEME_DEFAULT,
                        // 'pluginOptions' => [
                        //     'allowClear' => true
                        // ],
                ]) ?>
          </div>
        </div>

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
                      'id_detalle',
                      'prod_detalle',
                      'cant_detalle',
                  ],
              ]); ?>

              <div class="row">
                  <div class="col-sm-5 col-xs-12"><?= Yii::t( 'pedido', 'Product')?></div>
                  <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'Qtty')?></div>
                  <div class="col-sm-1 col-xs-12"><?= Yii::t( 'pedido', 'L. price')?></div>
                  <div class="col-sm-1 col-xs-12">
                    <button type="button" class="add-item btn btn-success btn-flat btn-md" style="width:100%"  data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Add item')?>"><i class="fa fa-plus"></i></button>
                  </div>
              </div>
              <hr>
              <div class="table-body"><!-- widgetContainer -->
              <?php foreach ($modelsDetalles as $index => $modelDetalle): ?>
                      <div class="row detalle-item"><!-- widgetBody -->
                        <div class="col-sm-8 col-xs-12">
                        <?php
                          // necessary for update action.
                          if (!$modelDetalle->isNewRecord) {
                              echo Html::activeHiddenInput($modelDetalle, "[{$index}]id_detalle");
                              //$modelSucursal->empresa_suc[$index] = $model->id_empresa;
                              echo Html::activeHiddenInput($modelDetalle, "[{$index}]trans_detalle");
                          }
                          $url = Url::to(['producto/producto-list']);
                          $productos = empty($modelDetalle->prod_pdetalle) ? '' : Producto::findOne($modelDetalle->prod_detalle)->cod_prod.' '.Producto::findOne($modelDetalle->prod_detalle)->des_prod;
                          echo $form->field($modelDetalle, "[{$index}]prod_detalle",[
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
                              'templateResult' => new JsExpression('function(cliente) { return cliente.text; }'),
                              'templateSelection' => new JsExpression('function (cliente) {
                                  return cliente.text;
                                }'),
                              ],
                          ])->label(false);
                          ?>

                        </div>
                        <div class="col-sm-3 col-xs-12">
                          <?= $form
                          ->field($modelDetalle,"[{$index}]cant_detalle",[ 'addClass' => 'form-control number-decimals'])
                          ->textInput(['type' => 'number','min' => 0, 'step' => 1])
                          ->label(false)?>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                          <button type="button" class="remove-item btn btn-danger btn-flat btn-sm" style="width:100%" data-toggle="tooltip" data-placement="top" title="<?= Yii::t('app','Delete item')?>"><i class="fa fa-trash"></i></button>
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
              <?= $form->field($model, 'obsv_trans')->textarea(['rows' => 6]) ?>
          </div>
        </div>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_movimiento', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
