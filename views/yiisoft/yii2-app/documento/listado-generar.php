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

$this->title = Yii::t('documento', 'Orders to bill');
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
                   return $data->tipo_pedido !== $data::PEDIDO  ? $data->tipo_pedido === Pedido::PROFORMA ? 'PROFORMA' : 'COTIZACION' : 'PEDIDO' ;
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
            //'estatus_pedido',
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
              'attribute'=>'total_pedido',
              'value' => function($data){
                   $total = Yii::$app->formatter->asDecimal($data->sumChildTotal());
                   return $total;
              },
              'width' => '20%'
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => ' {guia}&nbsp;&nbsp;{factura}&nbsp;&nbsp;{print} ',
                'buttons' => [
                  'guia' =>  function ($url, $model) {
                      return ( $model->estatus_pedido === $model::STATUS_INACTIVO) ?
                            Html::a(
                              '<button class="btn btn-flat btn-success">'.Yii::t('documento','Generate guide').'&nbsp; &nbsp;<i class="fa fa-play-circle"></i></button>',
                              $url,
                              [
                                  'title' => Yii::t('documento', 'Generate guide'),
                                  'class' => 'pjax-guide',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                              ]) : '';
                  } ,
                  'factura' =>  function ($url, $model) {
                      return ( $model->estatus_pedido === $model::GUIA_GENERADA) ?
                            Html::a('<button class="btn btn-flat btn-primary">'.Yii::t('documento','Generate document').'&nbsp; &nbsp;<i class="fa fa-play-circle"></i></button>',
                            $url,
                            [
                                  'title' => Yii::t('documento', 'Generate document'),
                                  'class' => 'pjax-document',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                            ]) : '' ;
                  },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'factura') {
                      $url = Url::to(['documento/factura-create','id' => $model->id_pedido]);
                      return $url;
                  }

                  if ($action === 'guia') {
                      $url = Url::to(['documento/guia-create','id' => $model->id_pedido]);
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

//Guia
$this->registerJsVar( "buttonGuide", ".pjax-guide" );
$this->registerJsVar( "frameGuide", "#frame-guide" );
$this->registerJsVar( "modalGuide", "#modal-guide" );
$this->registerJsVar( "submitGuide", "#submitGuia" );
echo   $this->render('//site/_modalGuide',[]);

//Factura
$this->registerJsVar( "buttonPrint", ".pjax-print" );
$this->registerJsVar( "buttonCreate", ".pjax-document" );
$this->registerJsVar( "buttonSubmit", "#submit" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
echo   $this->render('//site/_modalForm',[]);

//Reporte
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);
