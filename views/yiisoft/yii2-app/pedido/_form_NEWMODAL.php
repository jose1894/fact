<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Vendedor;
use app\models\Moneda;
use app\models\Almacen;
use app\models\CondPago;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\form\ActiveField;
use yii\web\View ;
use kartik\select2\Select2;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\components\AutoIncrement;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use kartik\builder\TabularForm;

if ( $model->isNewRecord ) {
  $model->cod_pedido = AutoIncrement::getAutoIncrementPad( 'pedido' );
}
?>

<div class="person-form">

    <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true, 'enableClientValidation' => true]); ?>

    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'cod_pedido')->textInput(['maxlength' => true,'readonly' => true]) ?>
      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?php
          $model->fecha_pedido = date('d/m/Y');
          echo $form->field($model, 'fecha_pedido',[
          'addClass' => 'form-control'
          ])->widget(DatePicker::classname(),[
                'value' => date('d/m/Y'),
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'format' => 'dd/mm/yyyy',
                    'autoclose' => true,
                    'altFormat' => 'dd-mm-dd'
                ]
            ]) ?>
      </div>

      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <?php
        $url = Url::to(['cliente/cliente-list']);

        $cliente = empty($model->clte_pedido) ? '' : Cliente::findOne($model->clte_pedido)->nombre_clte;

        echo $form->field($model, 'clte_pedido',[
          'addClass' => 'form-control',
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
                        vendedor = cliente.vendedor;

                    if ( textDirecc.trim() ){
                      $( "#pedido-direccion_pedido" ).val( textDirecc );
                    }

                    if ( condp ){
                      $( "#pedido-condp_pedido" ).val( condp );
                      $( "#pedido-condp_pedido" ).trigger( "change" );
                    }

                    if ( vendedor ){
                      $( "#pedido-vend_pedido" ).val( vendedor );
                      $( "#pedido-vend_pedido" ).trigger( "change" );
                    }
                    return cliente.text;
                  }'),
            ],
        ])
        ?>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
        <label for=""><?= Yii::t('cliente','Address') ?></label>

        <?php
          $direcc = "";
          if ( !$model->isNewRecord ) {
              $query = new Query;
              $query->select(['c.direcc_clte','CONCAT(dt.des_dtto,\' - \', dp.des_depto,\' - \',pr.des_prov, \' - \',p.des_pais) as \'geo\''])
                  ->from(['cliente as c'])
                  ->join('inner join ', ['distrito as dt'],' c.dtto_clte = dt.id_dtto and dt.status_dtto = 1 ')
                  ->join('inner join ', ['provincia as pr'] ,' c.provi_cte = pr.id_prov and pr.status_prov = 1 ')
                  ->join('inner join ',['departamento as dp'],' c.depto_cte = dp.id_depto and dp.status_depto = 1 ')
                  ->join('inner join ',['pais as p'],' c.pais_cte = p.id_pais and p.status_pais = 1')
                  ->where('c.id_clte = :id',[':id' => $model->clte_pedido])
                  ->limit(1);
              $command = $query->createCommand();
              $data = $command->queryAll();
              $data = array_values($data);
              $direcc = $data[0]['direcc_clte']." ".$data[0]['geo'] ;
              //exit();
          }

          echo  Html::textArea('pedido', $direcc ,[
            'id'=>'pedido-direccion_pedido',
            'class' => 'form-control',
            'rows' => 2,
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
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php $vendedores = Vendedor::find()->where(['estatus_vend' => 1])
        ->orderBy('nombre_vend')
        ->all();
        $vendedores = ArrayHelper::map($vendedores,'id_vendedor','nombre_vend');
        ?>
        <?= $form->field($model, 'vend_pedido',[
          'addClass' => 'form-control'
          ])->widget(Select2::classname(), [
                    'data' => $vendedores,
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-users"></i>']],
                    'options' => ['placeholder' => Yii::t('vendedor','Select a seller').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'initialize' => true,
                        'allowClear' => true
                    ],
            ])?>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php $monedas = Moneda::find()->where(['status_moneda' => 1])
        ->orderBy('des_moneda')
        ->all();
        $monedas = ArrayHelper::map( $monedas, 'id_moneda', 'des_moneda');
        ?>
        <?= $form->field($model, 'moneda_pedido',[
          'addClass' => 'form-control'
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
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php $almacenes = Almacen::find()->where(['status_almacen' => 1])
        ->orderBy('des_almacen')
        ->all();
        $almacenes = ArrayHelper::map( $almacenes, 'id_almacen', 'des_almacen');
        ?>
        <?= $form->field($model, 'almacen_pedido',[
          'addClass' => 'form-control'
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
          'addClass' => 'form-control'
          ])->widget(Select2::classname(), [
                    'data' => $condiciones,
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']],
                    'options' => ['placeholder' => Yii::t('condicionp','Select a payment condition').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
            ])?>
      </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



<?php
echo Html::beginForm();
echo TabularForm::widget([
    // your data provider
    'dataProvider'=>$dataProvider,

    // set entire form to static only (read only)
    'staticOnly'=>true,
    'actionColumn'=>false,

    // formName is mandatory for non active forms
    // you can get all attributes in your controller
    // using $_POST['kvTabForm']
    'formName'=>'kvTabForm',

    // set defaults for rendering your attributes
    'attributeDefaults'=>[
        'type'=>TabularForm::INPUT_TEXT,
    ],

    // configure attributes to display
    'attributes'=>[
        'id'=>['label'=>'ID', 'type'=>TabularForm::INPUT_HIDDEN_STATIC],
        'name'=>['label'=>'Book Name'],
        'details'=>[
            'type'=>TabularForm::INPUT_RAW,
            'staticValue' => function($m, $k, $i, $w) {
                return 'Details for book ' . ($k + 1);
            },
            'value' => function($m, $k, $i, $w) {
                return Html::textInput("details", 'Details for book ' . ($k + 1), ['class'=>'form-control']);
            }
        ],
        'publish_date'=>['label'=>'Published On', 'type'=>TabularForm::INPUT_STATIC],
    ],

    // configure other gridview settings
    'gridSettings'=>[
        'panel'=>[
            'heading'=>'<i class="fas fa-book"></i> Manage Books',
            'before' => false,
            'type'=>GridView::TYPE_PRIMARY,
            'before'=>false,
            'footer'=>false,
            'after'=>Html::button('<i class="fas fa-plus"></i> Add New', ['type'=>'button', 'class'=>'btn btn-success kv-batch-create']) . ' ' .
                    Html::button('<i class="fas fa-times"></i> Delete', ['type'=>'button', 'class'=>'btn btn-danger kv-batch-delete']) . ' ' .
                    Html::button('<i class="fas fa-save"></i> Save', ['type'=>'button', 'class'=>'btn btn-primary kv-batch-save'])
        ],
    ]
]);
echo Html::endForm();

$this->registerJs("
  $( document ).ready( function( ){
    $( '.kv-batch-create' ).on( 'click', function( e ){
      e.preventDefault();
      e.stopPropagation();
      console.log('Click');

      let parent = window.parent;
      parent.$( parent.modal_detail ).modal(\"show\");


  })
});
", VIEW::POS_END);






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
