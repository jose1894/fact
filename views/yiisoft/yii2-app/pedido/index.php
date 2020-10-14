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

$this->title = Yii::t('pedido', 'Order');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('pedido', 'Create order'), ['create'], ['class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            [
              'attribute'=>'tipo_pedido',
              'value' => function($data) {
                  if ($data->tipo_pedido !== Pedido::PEDIDO) {
                      if ($data->tipo_pedido === Pedido::PROFORMA) {
                        return 'PROFORMA';
                      } else {
                        return 'COTIZACION';
                      }
                  }
                  return 'PEDIDO' ;
              },
              'filter'=>[ Pedido::PEDIDO => 'PEDIDO', Pedido::PROFORMA => 'PROFORMA', Pedido::COTIZACION=> 'COTIZACION' ],
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '12%'
            ],
            [
              'attribute'=>'cod_pedido',
              'width' => '8%'
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
              'width' => '30%'
            ],
            [
              'attribute'=>'vend_pedido',
              'value' => function($data){
                   return $data->vendPedido->nombre_vend;
              },
              'filter'=>Vendedor::getVendedoresList(),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '10%'
            ],
            [
                'attribute'=>'estatus_pedido',
                'value' => function($data){
                    $arr = [
                        Pedido::STATUS_INACTIVO => 'PENDIENTE',
                        Pedido::GUIA_GENERADA => 'GUIA GENERADA',
                        Pedido::DOCUMENTO_GENERADO => 'DOCUMENTO GENERADO',
                        Pedido::PEDIDO_ANULADO => 'ANULADO',
                        Pedido::PEDIDO_FINALIZADO => ' FINALIZADO',
                    ];
                    return $arr[$data->estatus_pedido];
                },
                'filter'=>[
                        Pedido::STATUS_INACTIVO => 'PENDIENTE',
                        Pedido::GUIA_GENERADA => 'GUIA GENERADA',
                        Pedido::DOCUMENTO_GENERADO => 'DOCUMENTO GENERADO',
                        Pedido::PEDIDO_ANULADO => 'ANULADO',
                        Pedido::PEDIDO_FINALIZADO => 'FINALIZADO',
                ],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'language' => Yii::$app->language,
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => ['allowClear' => true],
                    'pluginEvents' =>[],
                    'options' => ['prompt' => ''],
                ],
                'width' => '10%'
            ],
            [
                'label' => 'Total',
                'value' => function($data){
                    $total = Yii::$app->formatter->asDecimal($data->sumChildTotal());
                    return $total;
                },
                'hAlign' => 'center',
                'width' => '5%',
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => ' {print} &nbsp; {view} &nbsp; {update} &nbsp; {anular}',
                'buttons' => [
                  'print' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                  'title' => Yii::t('app', 'Print'),
                                  'class' => 'pjax-print',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                      ]);
                  },
                  'view' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                  'title' => Yii::t('app', 'View'),
                                  'class' => 'pjax-view',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return ($model->estatus_pedido === $model::STATUS_INACTIVO) ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  // 'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                      ]) : '' ;
                  },
                  'anular' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                  'title' => Yii::t('app', 'Anular'),
                                  'class' => 'pjax-cancel',
                                  'data' => [
                                      'message' => Yii::t('app','Are you sure you want to anular this item?'),
                                      'succmessage' => Yii::t('app', 'Item deleted successfully!'),
                                      'method' => 'post',
                                      'pjax' => 0,
                                      'icon' => 'warning',
                                      'title' => Yii::t('pedido', 'Order'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_pedido
                                  ],
                      ]);
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'print') {
                      $url = Url::to(['pedido/pedido-rpt','id' => $model->id_pedido]);
                      return $url;
                  }
                  if ($action === 'view') {
                      $url = Url::to(['pedido/view','id' => $model->id_pedido]);
                      return $url;
                  }
                  if ($action === 'update') {
                      $url = Url::to(['pedido/update','id' => $model->id_pedido]);
                      return $url;
                  }
                  if ($action === 'anular') {
                    $url = Url::to(['pedido/anular','id' => $model->id_pedido]);
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
$this->registerJsVar( "buttonCreate", "#create" );
$this->registerJsVar( "buttonSubmit", "submit" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
//Detalles
echo   $this->render('//site/_modalForm',[]);

$this->registerJsVar( "buttonPrint", ".pjax-print" );
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);
$js = "
  $('.pjax-cancel').click(function(){
    alert('acaa');

  })

"; 
$this->registerJs($js,View::POS_LOAD);
