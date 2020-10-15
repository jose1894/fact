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
use app\controllers\SiteController;
// on your view layout file
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Product movement');
$this->params['breadcrumbs'][] = $this->title;
$status = [ 2 => 'DOCUMENTO GENERADO', 3 => 'DOCUMENTO ANULADO'];
$primerDiaMes = date('01/MM/yyyy'); // hard-coded '01' for first day
$ultimoDiaMes  = date('dd/MM/yyyy');
?>
<div class="documento-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid', 'timeout' => 3000]); ?>

    <p><?php  echo $this->render('_searchKardex', ['model' => $searchModel]); ?></p>

	<?php
		$isFa = true;
    // $isFa below determines if export['fontAwesome'] property is set to true.
    $get = Yii::$app->request->get();
    $rs = "";
    $fecha = "";

    if (!empty($get)) {
        if ( !empty($get['TransaccionSearch']['fecha_trans'])) {
            $fecha = $get['TransaccionSearch']['fecha_trans'];
        }

        if (!empty($fecha)) {
            $fechaDoc = explode(" - ", $fecha);
            $rs = "<br>" . Yii::t('app', 'From') . " " . $fechaDoc[0] . " ". Yii::t('app','to')." ". $fechaDoc[1];
        }
    }

    $pdfHeader = '
    <table class="" style="">
        <tr>
            <td width="25%">
              <div class="rounded"> <img src="'.Url::to('img/logo.jpg').'" width="180px"/> </div>
            </td>
            <td width="50%" align="center" >
              <div class="titulo-emp" style="font-size:20px;font-weight:bold;">' . SiteController::getEmpresa()->nombre_empresa . '</div><br>
              <div class="datos-emp">' . SiteController::getEmpresa()->direcc_empresa . '</div>
              <div class="datos-emp">' . SiteController::getEmpresa()->tlf_empresa . '</div>
              <div class="datos-emp">' . SiteController::getEmpresa()->movil_empresa . '</div>
              <div class="datos-emp">' . SiteController::getEmpresa()->correo_empresa . '</div>
            </td>
            <td width="25%" align="right">
                <b>' . Yii::t('app', 'Date') . ':</b> {DATE d/m/Y}
                <br>
                <b>' . Yii::t('app', 'Hour') . ':</b> {DATE H:i:s}
                <br>
                <b>' . Yii::t('app', 'Page') . ':</b> {PAGENO}/{nbpg}
            </td>
        </tr>
    </table>
    <hr>
    <table width="100%">
    <tr>
        <td colspan="3" style="text-align:center">
            <b>'. Yii::t('rpts', 'Product movement'). '</b> <br>
            <b>'. $rs.'</b> <br>
        </td>
    </tr>
    </table>
    ';
		$exportConfig = [
			GridView::EXCEL => [
				'label' => Yii::t('app', 'Excel'),
				'icon' => 'fa-file-excel-o',
				'iconOptions' => ['class' => 'text-success'],
				'showHeader' => true,
				'showPageSummary' => true,
				'showFooter' => true,
				'showCaption' => true,
				'filename' => Yii::t('app', 'kardex'),
				'alertMsg' => Yii::t('app', 'The EXCEL export file will be generated for download.'),
				'options' => ['title' => Yii::t('app', 'Microsoft Excel 95+')],
				'mime' => 'application/vnd.ms-excel',
				'config' => [
					'worksheet' => Yii::t('app', 'Kardex'),
					'cssFile' => ''
				]
			],
			GridView::PDF => [
				'label' => Yii::t('app', 'PDF'),
				'icon' =>  'fa-file-pdf-o',
				'iconOptions' => ['class' => 'text-danger'],
				'showHeader' => true,
				'showPageSummary' => true,
				'showFooter' => true,
				'showCaption' => true,
				'filename' => Yii::t('rpts', 'Product movement'),
				'alertMsg' => Yii::t('app', 'The PDF export file will be generated for download.'),
				'options' => ['title' => Yii::t('app', 'Portable Document Format')],
				'mime' => 'application/pdf',
				'config' => [
					'mode' => 'c',
					'format' => 'A4-L',
					'destination' => 'I',
					'marginTop' => 60,
					'marginBottom' => 20,
          'cssFile' => '@webroot/css/rptCss.css',
          'methods' => [
               'SetHeader' => $pdfHeader,
              'SetFooter' => "",
          ],
					'options' => [
						'title' => 'Title',
						'subject' => Yii::t('app', 'PDF export generated by kartik-v/yii2-grid extension'),
						'keywords' => Yii::t('app', 'krajee, grid, export, yii2-grid, pdf')
					],
					'contentBefore'=>'',
					'contentAfter'=>''
				]
			],

		];

    $prod = "";

    if ( !empty($dataProvider->getModels()) ) {
      $prod = $dataProvider->getModels()[0]['cod_prod']." - ".trim($dataProvider->getModels()[0]['des_prod']);
    } else {
      $this->registerJs('
          swal("Warning", "' . Yii::t('rpts', 'No data to display!') . '", "warning");
      ',View::POS_END);
    }
	?>



    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pjax' => true,
        				'toolbar' => [
                    [
                        'content'=> (!empty($prod)) ? '<button class="btn btn-flat btn-success">'.$prod.'</btn>' : "",
                    ],
          					'{export}',
          					'{toggleData}'
        				],
                'export' => [
                  'showConfirmAlert' => false,
                ],
        				'exportConfig' => $exportConfig,
        				'panel' => [
        					'heading'=>'<h3 class="panel-title"><i class="fa fa-book"></i> ' . Yii::t('app','Product movement') . '</h3>',
        					// 'type'=>'success',
        					// 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        					// 'after'=>Html::a('<i class="fa fa-refresh"></i> ' . Yii::t('app','Refresh '), ['listado-factura'], ['class' => 'btn btn-success']),
        					// 'footer'=>true,
        				],
                'showPageSummary' => true,
                'columns' => [
                          [

							'label' => Yii::t('app', 'Date'),
                            'attribute' => 'fecha_trans',
                            'format' => ['date', 'php:d/m/Y']
                          ],
                          [
                            'attribute' => 'docref_trans',
							              'label' => 'Documento',
                          ],
                          [
                            'attribute' => 'codigo_trans',
                            'label' => 'Codigo',
                          ],
                          [
                            'attribute' => 'ope_trans',
                            'label' => 'Operacion',
                          ],
                          [
                            'attribute' => 'des_tipom',
                            'label' => 'Movimiento',
                          ],
                          [
                            'attribute' => 'des_tipod',
                            'label' => 'Tipo documento',
                          ],
                          [
                            'attribute' => 'precio_compra_ext',
                            'label' => 'P.Compra$',
                            'width' => '5%',
                            'format' => ['decimal',2],
                            'hAlign' => 'right',
                          ],
                          [
                            'attribute' => 'ingreso_unidades',
                            'label' => 'Ingreso',
                            'format' => ['decimal',2],
                            'width' => '5%',
                            'format' => ['decimal',2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
                          ],
                          // 'moneda',
                          // [
                          //   'attribute' => 'precio_compra_soles',
                          //   'label' => 'P.Compra/S',
                          //   'width' => '5%',
                          //   'format' => ['decimal',2],
                          //   'hAlign' => 'right',
                          // ],
                          // [
                          //   'attribute' => 'ingreso_valorizados',
                          //   'label' => 'I.Valorizados',
                          //   'format' => ['decimal',2],
                          //   'hAlign' => 'right',
                          // ],
                          [
                            'attribute' => 'salidas_unidades',
                            'value' => function( $data ) {
                                return $data['salidas_unidades'];
                            },
                            'label' => 'Salidas',
                            'width' => '5%',
                            'format' => ['decimal',2],
                            'hAlign' => 'right',
                            'pageSummary' => true,
            						  ],
            						  [
            							  'attribute' => 'saldo',
                            'format' => ['decimal',2],
                            'hAlign' => 'right',
            						  ]
                  ]
              ]);?>
        <?php Pjax::end(); ?>
</div>
<?php
// $this->registerCss(".kv-grid-table{ width: 1600px !important; }");
$this->registerJsVar( "buttonCreate", "" );
$this->registerJsVar( "buttonSubmit", "" );
$this->registerJsVar( "buttonCancel", "" );
$this->registerJsVar( "buttonPrint", "" );
$this->registerJsVar( "frameRpt", "" );
