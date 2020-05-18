<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use app\models\Producto;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View ;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDetalle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-sm-4 col-xs-12">
        <?php
        $url = Url::to(['producto/producto-list']);

        $producto = empty($model->prod_pdetalle) ? '' : Producto::findOne($model->prod_pdetalle)->id_prod;

        echo $form->field($model, 'prod_pdetalle',[
          'addClass' => 'form-control',
          ])->widget(Select2::classname(), [
            'language' => Yii::$app->language,
            'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-cube"></i>']],
            'initValueText' => $producto, // set the initial display text
            'options' => ['placeholder' => Yii::t('cliente','Select a product').'...'],
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
                  'data' => new JsExpression('function(params) { return {desc:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(producto) { return producto.texto; }'),
                'templateSelection' => new JsExpression('function (producto) {
                    $( "#description" ).val( producto.des_prod );
                    return producto.cod_prod;
                  }'),
            ],
        ])
        ?>
      </div>
      <div class="col-sm-8 col-xs-12">

        <label><?= Yii::t('pedido','Description') ?></label>
        <?= Html::textArea('description', '', ['class' => 'form-control', 'row'=>'2', 'id' => 'description', 'readonly' => true]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-xs-12">
        <?= $form->field($model, 'cant_pdetalle')->textInput(['maxlength' => true,'type' => 'number', 'style'=>['text-align' => 'right']]) ?>
      </div>
      <div class="col-sm-2 col-xs-12">
        <label for=""><?= Yii::t('pedido','List price')?></label>
        <?= Html::input("text","pedido-precio_lista","0.00",['class' => 'form-control','id'=> 'pedido-precio_lista','style'=>[ 'text-align'=>'right'],'readonly' => true]) ?>
      </div>
      <div class="col-sm-2 col-xs-12">
        <?= $form->field($model, 'descu_pdetalle')->widget(NumberControl::classname(),[]) ?>
      </div>
      <div class="col-sm-2 col-xs-12">
        <?= $form->field($model, 'impuesto_pdetalle')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-sm-2 col-xs-12">
        <?= $form->field($model, 'precio_pdetalle')->widget(NumberControl::classname(),[]) ?>
      </div>
      <div class="col-sm-2 col-xs-12">
        <label for="">Total</label>
        <?= Html::input("text","total","0.00",['class' => 'form-control','id'=> 'total','readonly' => true,'style'=>[ 'text-align'=>'right','color' =>'red', 'font-size'=> '2rem']]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 col-xs-12">
        <label for="">Stock minimo</label>
        <?= Html::input("text","total","0.00",['class' => 'form-control','id'=> 'total','readonly' => true,'style'=>[ 'text-align'=>'right']]) ?>
      </div>
      <div class="col-sm-4 col-xs-12">
        <label for="">Stock maximo</label>
        <?= Html::input("text","total","0.00",['class' => 'form-control','id'=> 'total','readonly' => true,'style'=>[ 'text-align'=>'right']]) ?>
      </div>
      <div class="col-sm-4 col-xs-12">
        <label for="">Stock actual</label>
        <?= Html::input("text","total","0.00",['class' => 'form-control','id'=> 'total','readonly' => true,'style'=>[ 'text-align'=>'right','color' =>'red', 'font-size'=> '2rem']]) ?>
      </div>
    </div>






    <?php // $form->field($model, 'status_pdetalle')->textInput() ?>

    <?php // $form->field($model, 'pedido_pdetalle')->textInput() ?>

    <?php
      echo Html::hiddenInput('PedidoDetalle[pedido_pdetalle]', $model->pedido_pdetalle, ['id' => 'pedidodetalle-pedido_pdetalle']);
      ActiveForm::end();
    ?>

</div>
<?php
$this->registerJs(<<<JS
$('#pedido_tipo  input[type="radio"]').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
})
$("select").on("select2:unselecting", function (e) {
               $(this).select2("val", "");
               $(this).val(null).trigger('change');
               e.preventDefault();
           });
JS
, VIEW::POS_END);
