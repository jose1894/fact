<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use app\controllers\SiteController;


/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('rpts', 'Inventory');
$this->params['breadcrumbs'][] = $this->title;

$pdfHeader = '
<table class="" style="">
    <tr>
        <td width="25%">
          <div class="rounded"> <img src="'.Url::to([SiteController::getEmpresa()->image_empresa]).'" width="180px"  height="100px"/> </div>
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
        <b>'. Yii::t('rpts', 'Inventory'). '</b> <br>
        <b></b> <br>
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
    'filename' => Yii::t('rpts', 'Inventory'),
    'alertMsg' => Yii::t('app', 'The EXCEL export file will be generated for download.'),
    'options' => ['title' => Yii::t('app', 'Microsoft Excel 95+')],
    'mime' => 'application/vnd.ms-excel',
    'config' => [
      'worksheet' => Yii::t('rpts', 'Inventory'),
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
    'filename' => Yii::t('rpts', 'Inventory'),
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

?>

<div class="documento-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid', 'timeout' => 3000]); ?>

    <p><?php echo $this->render('_searchInventory', ['model' => $searchModel]); ?></p>


    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pjax' => true,
                'toolbar' => [
                    '{export}',
                    '{toggleData}'
                ],
                'export' => [
                  'showConfirmAlert' => false,
                ],
                'exportConfig' => $exportConfig,
                'panel' => [
                  'heading'=>'<h3 class="panel-title"><i class="fa fa-book"></i> ' . Yii::t('rpts','Inventory') . '</h3>',
                ],
                'columns' => [
                          [
                            'attribute' => 'tipo_prod',
                            'value' => function ($model) {
                              return $model['desc_tpdcto'];
                            },
                            'label' => Yii::t('tipo_producto', 'Product type'),
                            'group' => true,  // enable grouping
                            'groupedRow' => true,                    // move grouped column to a single grouped row
                            'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
                            'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
                          ],

                          [
                            'attribute' => 'cod_prod',
                            'label' => Yii::t('producto','Code'),
                          ],
                          [
                            'attribute' => 'des_prod',
                            'label' => Yii::t('producto','Description'),
                          ],
                          [
                            'attribute' => 'stock_total',
                            'format' => ['decimal',0],
                            'hAlign' => 'right',
                          ],
                          [
                            'attribute' => 'stock_asignado',
                            'format' => ['decimal',0],
                            'hAlign' => 'right',
                          ],
                          [
                            'attribute' => 'stock_disponible',
                            'format' => ['decimal',0],
                            'hAlign' => 'right',
                          ],
                          [
                            'attribute' => 'precio_lista',
                            'format' => ['decimal',2],
                            'hAlign' => 'right',
                          ],
                          [
                            'attribute' => 'total_valorizado',
                            'format' => ['decimal',2],
                            'hAlign' => 'right',
                          ],
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
