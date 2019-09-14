<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Cliente;
use app\models\Pedido;
use app\models\Vendedor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
// use app\models\Provincia;
// use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documento', 'Order list to bill');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'tipo_pedido',
              'value' => function($data){
                   return $data->tipo_pedido !== Pedido::PEDIDO  ? $data->tipo_pedido === Pedido::PROFORMA ? 'PROFORMA' : 'COTIZACION' : 'PEDIDO' ;
              },
              'width' => '12%'
            ],
            [
              'attribute'=>'cod_pedido',
              'width' => '7%'
            ],
            [
              'attribute'=>'fecha_pedido',
              'value' => function($data){
                   return Yii::$app->formatter->asDate($data->fecha_pedido, 'dd/MM/yyyy');
              },
              'width' => '8%'
            ],
            [
              'attribute'=>'clte_pedido',
              'value' => function($data){
                   return $data->cltePedido->nombre_clte;
              },
              'filter'=>Cliente::getClienteList(),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '50%'
            ],
            [
              'attribute'=>'Total',
              'value' => function($data){
                   $total = Yii::$app->formatter->asDecimal($data->sumChildTotal());
                   return $total;
              },
              'width' => '20%'
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => ' {factura}&nbsp;&nbsp;{print} ',
                'buttons' => [
                  'factura' => function ($url, $model) {
                      return Html::a('<button class="btn btn-flat btn-success">'.Yii::t('documento','Generate document').'&nbsp; &nbsp;<i class="fa fa-play-circle"></i></button>', $url, [
                                  'title' => Yii::t('documento', 'Generate documento'),
                                  'class' => 'pjax-document',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                      ]);
                  },
                  'print' => function ($url, $model) {
                      return Html::a('<button class="btn btn-flat btn-primary">'.Yii::t('app','Print').'&nbsp; &nbsp;<i class="fa fa-print"></i></button>', $url, [
                                  'title' => Yii::t('documento', 'Print'),
                                  'class' => 'pjax-print',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                      ]);
                  },

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'factura') {
                      $url = Url::to(['documento/factura-create','id' => $model->id_pedido]);
                      return $url;
                  }
                }
              ],
          ],
          'pjax'=>true,
          'pjaxSettings'=>[
             'neverTimeout'=>true,
          ],
          'krajeeDialogSettings' => ['overrideYiiConfirm' => false]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php
//Maestro
$this->registerJsVar( "buttonPrint", ".pjax-print" );
$this->registerJsVar( "buttonCreate", ".pjax-document" );
$this->registerJsVar( "buttonSubmit", "#submit" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
//Detalles
echo   $this->render('//site/_modalForm',[]);

$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);

$js = '
  $( ".pjax-invoice" ).on( "click", function( e ){
    e.preventDefault();
    console.log("Click");
  })
';

$this->registerJs($js,View::POS_END);
