<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Documento;
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
$status = [
  Documento::GUIA_GENERADA => 'GUIA GENERADA',
  Documento::DOCUMENTO_GENERADO => 'DOCUMENTO GENERADO',
  Documento::DOCUMENTO_ANULADO => 'ANULADO'
];
?>
<div class="pedido-index">
    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('documento', 'Create referal guide'), ['documento/guia-new' ,'asDialog'=>1], ['id'=>'create','class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'grid', 'timeout' => 3000]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>

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
            [
              'attribute'=>'tipomov_doc',
              'value' => 'tipoMovDoc.des_tipom'
            ],
            [
                'attribute' => 'status_doc',
                'filter' => $status,
                'value' => function($data){
                    $status = [
                      Documento::GUIA_GENERADA => 'GUIA GENERADA',
                      Documento::DOCUMENTO_GENERADO => 'DOCUMENTO GENERADO',
                      Documento::DOCUMENTO_ANULADO => 'ANULADO'
                    ];
                    return $status[$data->status_doc];
                },
                'hAlign' => 'left',
                'vAlign' => 'middle',
                //'width' => '10%',
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
                'template' => ' {rpt} ',
                'buttons' => [
                  'rpt' =>  function ($url, $model) {
                      return
                          Html::a('<button class="btn btn-flat btn-xs btn-primary"><i class="fa fa-print"></i></button>',
                              $url,
                              [
                                  'title' => Yii::t('app', 'Print'),
                                  'class' => 'pjax-rpt',
                                  'data' => [
                                      'id' => $model->id_doc,
                                  ]
                              ]) ;
                  },

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'rpt') {
                      $id = $model->guiaRem->id_doc;
                      return Url::to(['documento/guia-rpt','id' => $id]);
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

$js = <<<JS
$( 'body' ).on( 'click', '.pjax-rpt', function( e ){
    e.preventDefault();
    let url = $( this ).prop( 'href' );
    window.open( url,'_blank');
});

$( 'body' ).on( 'click', '#create', function( e ) {
  e.preventDefault();
  e.stopPropagation();
  $( submitGuide ).css( 'display', 'block' );
  $( submitGuide ).css( 'float', 'right' );
  $( frameGuide ).attr( "src", $( this ).attr( 'href' ));
  $( modalGuide ).modal({
    backdrop: 'static',
    keyboard: false,
  });
  $( modalGuide ).modal("show");
});

JS;

$this->registerJs($js,View::POS_END);
