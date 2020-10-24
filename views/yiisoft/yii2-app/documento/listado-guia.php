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

$this->title = Yii::t('documento', 'Referal guide');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php Pjax::begin(['id' => 'grid', 'timeout' => 3000]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'cod_doc',
              'width' => '7%'
            ],
            [
              'attribute'=>'fecha_doc',
              'format' => ['date', 'php:d/m/Y'],
              // 'value' => function($data){
              //      return Yii::$app->formatter->asDate($data->fecha_pedido, 'dd/MM/yyyy');
              // },
              'width' => '8%'
            ],
            // [
            //   'attribute'=>'clte_pedido',
            //   'value' => function($data){
            //        return $data->cltePedido->nombre_clte;
            //   },
            //   'filter'=>Cliente::getClienteList(),
            //   'filterType' => GridView::FILTER_SELECT2,
            //   'filterWidgetOptions' => [
            //       'language' => Yii::$app->language,
            //       'theme' => Select2::THEME_DEFAULT,
            //       'pluginOptions' => ['allowClear' => true],
            //       'pluginEvents' =>[],
            //       'options' => ['prompt' => ''],
            //   ],
            //   'width' => '50%'
            // ],
            // [
            //   'attribute'=>'Total',
            //   'value' => function($data){
            //        $total = Yii::$app->formatter->asDecimal($data->sumChildTotal());
            //        return $total;
            //   },
            //   'width' => '20%'
            // ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => ' {factura} ',
                'buttons' => [
                  'factura' => function ($url, $model) {
                      return Html::a('<button class="btn btn-flat btn-success">'.Yii::t('app','Generate invoice').'&nbsp; &nbsp;<i class="fa fa-play-circle"></i></button>', "#", [
                                  'title' => Yii::t('app', 'Generate invoice'),
                                  'class' => 'pjax-invoice',
                                  'data' => [
                                    // 'id' => $model->id_pedido,
                                  ]
                      ]);
                  },

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'factura') {
                      $url = "#";
                      // $url = Url::to(['pedido/pedido-rpt','id' => $model->id_pedido]);
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
