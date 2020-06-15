<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use app\models\Cliente;
use app\models\Documento;
use app\models\NotaCredito;
use app\models\TipoDocumento;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documento', 'Cancel documents');
$this->params['breadcrumbs'][] = $this->title;
$status = [ 2 => 'DOCUMENTO GENERADO'];
$primerDiaMes = date('01-m-Y'); // hard-coded '01' for first day
$ultimoDiaMes  = date('d-m-Y');

?>
    <div class="documento-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin(['id' => 'grid']); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <!-- <p>
            <?= Html::a(Yii::t('documento', 'Create Documento'), ['create'], ['class' => 'btn btn-success']) ?>
        </p> -->

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'cod_doc',
                    'width' => '5%'
                ],
                [
                  'width' => '20%',
                  'value' => function($data){
                       return Yii::$app->formatter->asDate($data->fecha_doc, 'dd/MM/yyyy');
                  },
                  'attribute' => 'fecha_doc',
                  'hAlign' => 'center',
                  'vAlign' => 'middle',
                  'filterType' => GridView::FILTER_DATE_RANGE,
                  'filterWidgetOptions' => [
                          'presetDropdown'=>true,
                          'convertFormat'=>true,
                          // 'includeMonthsFilter'=>true,
                          'pluginOptions' => [
                                'locale' => ['format' => 'd/m/Y'],
                                'maxDate' => $ultimoDiaMes,
                          ],
                          'options' => ['placeholder' => Yii::t( 'app', 'Select range' )."..." ],
                          'pluginEvents' => [
                                  "apply.daterangepicker" => "function() { aplicarDateRangeFilter('FechaEmision') }",
                          ],
                  ],
              ],
              [
                  'attribute' => 'tipoDocumento',
                  'label' => Yii::t('tipo_documento','Document type'),
                  'value' => 'tipoDoc.des_tipod',
                  'filter'=>TipoDocumento::getTipoDocumentoList(NULL, TipoDocumento::ES_DOCUMENTO),
                  'filterType' => GridView::FILTER_SELECT2,
                  'filterWidgetOptions'=>[
                        'language' => Yii::$app->language,
                        'theme' => Select2::THEME_DEFAULT,
                        'pluginOptions'=>[
                                'allowClear'=>true,
                                'multiple'=>true
                        ],
              		],
                  'width' => '25%'
              ],
              [
                  'attribute' => 'cliente',
                  'label' => Yii::t('cliente','Customer'),
                  'value' => 'pedidoDoc.cltePedido.nombre_clte',
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
                  'class' => '\kartik\grid\ActionColumn',
                  'headerOptions' => ['style' => 'color:#337ab7'],
                  'template' => '{print}&nbsp;{anular}',
                  'buttons' => [
                      'print' =>  function ($url, $model) {
                          return  Html::a('<button class="btn btn-flat btn-primary"><i class="fa fa-print"></i></button>',
                                  $url,
                                  [
                                      'title' => Yii::t('app', 'Print'),
                                      'class' => 'pjax-print-document',
                                      'data' => [
                                          'id' => $model->id_doc,
                                      ]
                                  ]) ;
                      },
                      'anular' =>  function ($url, $model) {
                          return  Html::a('<button class="btn btn-flat btn-danger"><i class="fa fa-ban"></i></button>',
                              $url,
                              [
                                  'title' => Yii::t('documento', 'Cancel document'),
                                  'class' => 'pjax-cancel',
                                  'data' => [
                                      'id' => $model->id_doc,
                                    ]
                              ]
                            );
                      },
                  ],
                  'urlCreator' => function ($action, $model) {
                      if ($action === 'print') {
                          $url = "";
                          switch ($model->tipo_doc){
                            case Documento::TIPODOC_FACTURA:
                            case Documento::TIPODOC_BOLETA:
                                                      $url = 'documento/documento-rpt'; break;
                            case NotaCredito::TIPODOC_NCREDITO:
                                                      $url = 'nota-credito/nota-rpt'; break;
                          }
                          return Url::to([ $url ,'id' => $model->id_doc]);
                      }

                      if ($action === 'anular') {
                          $url = Url::to(['documento/anular-documento','id' => $model->id_doc]);
                          return $url;
                      }
                  }
              ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>

<?php

$js = <<<JS
    // debugger;
    $( 'body' ).on( 'click', '.pjax-print-document', function( e ){
        e.preventDefault();
        let url = $( this ).prop( 'href' );
        window.open( url,'_blank');
    });

    $( 'body' ).on( 'click', '.pjax-cancel', function( e ){
        e.preventDefault();
        let url = $( this ).prop( 'href' );

        $.ajax({
            url: url,
            success: function(data){
              var res = $.parseJSON(data);
              if( res ) {
                  swal(title, succMessage, "success")
                  $.pjax.reload( { container: '#grid' } );
                  return;
              }
            },
            error: function(data){
              let message;

              if ( data.responseJSON )
              {
                let error = data.responseJSON;
                message =   "Se ha encontrado un error: " +
                  "Code " + error.code +
                  "File: " + error.file +
                  "Line: " + error.line +
                  "Name: " + error.name +
                  "Message: " + error.message;
              }
              else
              {
                  message = data.responseText;
              }

              swal('Oops!!!',message,"error" );
                return;
            }
        });
    });

JS;
$this->registerJs( $js, View::POS_LOAD);

$js = <<<JS
function aplicarDateRangeFilter() {
  $('.grid-view').yiiGridView('applyFilter');
}
JS;
$this->registerJs( $js, View::POS_BEGIN);
