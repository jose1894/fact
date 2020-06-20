<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use app\models\Cliente;
use app\models\Documento;
use app\models\TipoDocumento;
use app\models\NotaCredito;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documento', 'Document list');
$this->params['breadcrumbs'][] = $this->title;
$status = [ 2 => 'DOCUMENTO GENERADO', 3 => 'DOCUMENTO ANULADO'];
$primerDiaMes = date('01/MM/yyyy'); // hard-coded '01' for first day
$ultimoDiaMes  = date('dd/MM/yyyy');
?>
    <div class="documento-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin(['id' => 'grid']); ?>
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
                                'showDropdowns'=>true
                          ],
                          'options' => ['placeholder' => Yii::t( 'app', 'Select range' )."..." ],
                          'pluginEvents' => [
                                  "apply.daterangepicker" => "function() { aplicarDateRangeFilter() }",
                          ],
                  ],
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
                        // 'options' => ['prompt' => '',],
                    ],
                    'filterInputOptions' =>[
                      'prompt' => '*',
                      'multiple' => true,
                    ],
                    'width' => '25%'
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
                    'width' => '15%'
                ],                
                [
                    'attribute' => 'status_doc',
                    'filter' => $status,
                    'value' => function($data){
                        $status = [ Documento::DOCUMENTO_GENERADO => 'DOCUMENTO GENERADO', Documento::DOCUMENTO_ANULADO => 'DOCUMENTO ANULADO'];
                        return $status[$data->status_doc];
                    },
                    'width' => '20%'
                ],
                [
                    'class' => '\kartik\grid\ActionColumn',
                    'headerOptions' => ['style' => 'color:#337ab7'],
                    'template' => '{print}&nbsp;&nbsp;{sunat} ',
                    'buttons' => [
                        'print' =>  function ($url, $model) {
                            return
                                Html::a('<button class="btn btn-flat btn-primary"><i class="fa fa-print"></i></button>',
                                    $url,
                                    [
                                        'title' => Yii::t('app', 'Print'),
                                        'class' => 'pjax-print-document',
                                        'data' => [
                                            'id' => $model->id_doc,
                                        ]
                                    ]) ;
                        },
                        'sunat' =>  function ($url, $model) {
                            return ($model->statussunat_doc < 0 && $model->status_doc == $model::DOCUMENTO_GENERADO) ? Html::a('<button class="btn btn-flat btn-success"><i class="fa fa-upload"></i></button>',
                                $url,
                                [
                                    'title' => Yii::t('app', 'Send'). ' SUNAT',
                                    'class' => 'pjax-send-sunat',
                                    'data' => [
                                        'id' => $model->id_doc,
                                    ]
                                ]) : (($model->statussunat_doc === 0) ? Html::a('<button class="btn btn-flat btn-success"><i class="fa fa-check"></i></button>',
                                '#',
                                [
                                    'title' => Yii::t('app', 'Sended'). ' SUNAT',
                                ]) : Html::a('<button class="btn btn-flat btn-danger"><i class="fa fa-ban"></i></button>',
                                    "",
                                    [
                                        'title' => Yii::t('app', 'CANCELED'),
                                        'class' => 'pjax-canceled',
                                    ]));
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

                        if ($action === 'sunat') {
                            $url = Url::to(['documento/ajax-gen-fact-xml','id' => $model->id_doc]);
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
    $( 'body' ).on( 'click', '.pjax-print-document', function( e ){
        e.preventDefault();
        let url = $( this ).prop( 'href' );
        window.open( url,'_blank');
    });

    $( 'body' ).on( 'click', '.pjax-send-sunat', function( e ){
        e.preventDefault();
        let url = $( this ).prop( 'href' );
        //debugger;
        $.ajax({
            url: url,
            success: function(data){
                data = JSON.parse(data);
                if ( data.code == "0" ){
                    swal('Success',data.description,'success');
                } else {
                    swal('Warning',data.code + ' - ' + data.description,'warning');
                }
                $.pjax.reload( { container: '#grid' } )

            },
            error: function(data){
                console.log(data);
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

echo   $this->render('//site/_modalForm',[]);
