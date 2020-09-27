<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Cliente;
use app\models\Documento;
use app\models\NotaCredito;
use app\models\Vendedor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
// use app\models\Provincia;
// use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documento', 'Credit note');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="pedido-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin(['id' => 'grid']); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


        <p>
            <?= Html::a(Yii::t('documento', 'Create credit note'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [                
                  [
                      'attribute' => 'cod_doc',
                      'hAlign' => 'center',
                      'vAlign' => 'middle',
                      'width' => '5%'
                  ],
                  [
                    'width' => '5%',
                    'value' => function($data){
                         return Yii::$app->formatter->asDate($data->fecha_doc, 'dd/MM/yyyy');
                    },
                    'attribute' => 'fecha_doc',
                    'hAlign' => 'center',
                    'vAlign' => 'middle',
                ],
                  [
                      'attribute' => 'cliente',
                      'label' => Yii::t('cliente','Customer'),
                      'value' => 'pedidoDoc.cltePedido.nombre_clte',
                      'width' => '25%',
                      'hAlign' => 'left',
                      'vAlign' => 'middle',
  
                  ],
                  [
                      'attribute' => 'tipoDocumento',
                      'label' => Yii::t('tipo_documento','Document type'),
                      'value' => 'tipoDoc.des_tipod',
                      'hAlign' => 'left',
                      'vAlign' => 'middle',
                      'width' => '15%',
                      // 'group' => true,  // enable grouping
                      // 'subGroupOf' => 1 // supplier column index is the parent group
                  ],
                  [
                      'attribute' => 'status_doc',
                      //'filter' => $status,
                      'value' => function($data){
                          $status = [ Documento::GUIA_GENERADA => 'GUIA GENERADA', Documento::DOCUMENTO_GENERADO => 'GENERADO', Documento::DOCUMENTO_ANULADO => 'ANULADO'];
                          return $status[$data->status_doc];
                      },
                      'hAlign' => 'left',
                      'vAlign' => 'middle',
                      'width' => '5%',
                      'pageSummary' => Yii::t('app','Page Summary'),
                      'pageSummaryOptions' => ['class' => 'text-right'],
                  ],
                  [
                    'attribute' => 'totalimp_doc',
                    'value' => function($data) {
                            $return = 0;

                            if ($data->tipo_doc === NotaCredito::TIPODOC_NCREDITO) {
                                $return = -1 * $data->totalimp_doc;
                            } 

                            return $return;
                    },
                    'hAlign' => 'center',
                    'width' => '10%',
                    'format' => ['decimal', 2],
                    'pageSummary' => true
                  ],
                  [
                    'attribute' => 'total_doc',
                    /*'value' => function($data) {
                      return ($data->status_doc !== Documento::DOCUMENTO_ANULADO) ? ($data->tipo_doc === NotaCredito::TIPODOC_NCREDITO ? -1 * $data->total_doc : $data->total_doc) : '0';
                    },*/
                    'hAlign' => 'center',
                    'width' => '10%',
                    'pageSummary' => true,
                    'format' => ['decimal', 2],
                  ],
                
                [
                    'class' => '\kartik\grid\ActionColumn',
                    'headerOptions' => ['style' => 'color:#337ab7'],
                    'template' => ' {guia}&nbsp;&nbsp;{factura}&nbsp;&nbsp;{print} ',
                    'buttons' => [
                        /*'guia' =>  function ($url, $model) {
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
                        },*/
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        /*if ($action === 'factura') {
                            $url = Url::to(['documento/factura-create','id' => $model->id_pedido]);
                            return $url;
                        }

                        if ($action === 'guia') {
                            //$url = Url::to(['documento/guia-create','id' => $model->id_pedido]);
                            //return $url;
                        }*/
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
$this->registerJsVar( "frameDocumento", "#frame-document" );
$this->registerJsVar( "modalDocumento", "#modal-document" );
$this->registerJsVar( "submitDocumento", "#submitDocument" );
echo   $this->render('//site/_modalDocumento',[]);

//Base
$this->registerJsVar( "buttonPrint", ".pjax-print" );
$this->registerJsVar( "buttonSubmit", "#submit" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "buttonCreate", "#create" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
echo   $this->render('//site/_modalForm',[]);

//Reporte
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);
