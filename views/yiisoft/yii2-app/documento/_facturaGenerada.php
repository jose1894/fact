<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use app\models\Cliente;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documento', 'Documentos');
$this->params['breadcrumbs'][] = $this->title;
$status = [ 2 => 'DOCUMENTO GENERADO', 3 => 'DOCUMENTO ANULADO'];
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('documento', 'Create Documento'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'cod_doc',
                'width' => '5%'
            ],
            [
                'attribute'=>'fecha_doc',
                'value' => function($data){
                    return Yii::$app->formatter->asDate($data->fecha_doc, 'dd/MM/yyyy');
                },
                'width' => '10%',
                'filterType' => GridView::FILTER_DATE,
                'contentOptions' => ['style'=>'text-align: right;'],
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
                'width' => '50%'
            ],
            [
                'attribute' => 'status_doc',
                'filter' => $status,
                'value' => function($data){
                        $status = [ 2 => 'DOCUMENTO GENERADO', 3 => 'DOCUMENTO ANULADO'];
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
                        return ($model->statussunat_doc < 0) ? Html::a('<button class="btn btn-flat btn-success"><i class="fa fa-play-circle-o"></i></button>',
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
                            ]) : '');
                    },
                ],
                'urlCreator' => function ($action, $model) {
                    if ($action === 'print') {
                        $url = Url::to(['documento/documento-rpt','id' => $model->id_doc]);
                        return $url;
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
        debugger;
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
                
            }            
        });
    });
    
JS;
$this->registerJs( $js, View::POS_LOAD);
