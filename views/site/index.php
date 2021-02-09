<?php
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\web\View;
use yii\web\JsExpression;
use app\controllers\SiteController;
use app\models\PedidoSearch;
use app\models\DocumentoSearch;
use app\models\CompraSearch;
use app\models\User;


$this->title = 'Resumen';


$date = DateTime::createFromFormat("d/m/Y", date("d/m/Y"));
$mes = Yii::t('app',strftime("%B",$date->getTimestamp()));
?>
<div class="site-index" >
        <section class="content">
          <!-- Small boxes (Stat box) -->
              <div class="col-lg-12" style="text-align:center; margin-bottom:10px; border-bottom: 1px solid grey;">
                <div class="img" style=""></div>
                <h1 style="font-weigth:bold"><?= SiteController::getEmpresa()->nombre_empresa?></h1>
                <h2><?= Yii::t('empresa','RUC') .' - ' . SiteController::getEmpresa()->ruc_empresa?></h2>
              </div>
              <hr>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3><?php
                      $model = PedidoSearch::showCountPedidos();
                      // print_r($model);
                      echo count($model);
                      ?></h3>
                    <p><?= Yii::t('pedido', 'New orders on').' '. $mes ?></p>
                  </div>
                  <div class="icon">
      			  <i class="ion ion-ios-albums-outline"></i>
                  </div>
                  <a href="<?= Url::to(['pedido/index'])?>" class="small-box-footer"><?= Yii::t('app','More')?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><?php
                      $model = DocumentoSearch::showCountFactura();
                      echo count($model);
                      ?></h3>

                    <p><?= Yii::t('documento', 'Documents on') . ' ' . $mes?></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="<?= Url::to(['documento/listado-factura'])?>" class="small-box-footer"><?= Yii::t('app', 'More')?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3><?php
                      $model = CompraSearch::showCountCompra();
                      echo count($model);
                      ?></h3>

                    <p><?= Yii::t('compra', 'Purchase orders on') . ' '. $mes?></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="<?= Url::to(['compra/index'])?>" class="small-box-footer"><?= Yii::t('app', 'More')?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->

            </div>

            <div class="row">
              <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Ventas por mes</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="areaChart" style="height:250px"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>

</div>




<?php


$ventasFacturas = DocumentoSearch::showVentasDiarias();
$ventasFNC = DocumentoSearch::showFNCDiarias();
$ventasBNC = DocumentoSearch::showBNCDiarias();
$ventasProformas = PedidoSearch::showVentasProformas();

 // var_dump($ventasProformas);exit();

 $dataFNC = ['0.00'];
 $labelsFNC = [date('Y')-0];
 foreach ($ventasFNC as $key => $value) {
   // code...
   $labelsFNC[] = $value['mesAno'];
   $dataFNC[] = Yii::$app->formatter->asDecimal($value['total']);
 }

 $dataBNC = ['0.00'];
 $labelsBNC = [date('Y')-0];
 foreach ($ventasBNC as $key => $value) {
   // code...
   $labelsBNC[] = $value['mesAno'];
   $dataBNC[] = Yii::$app->formatter->asDecimal($value['total']);
 }

$dataFact = ['0.00'];
$labelsFact = [date('Y')];
foreach ($ventasFacturas as $key => $value) {
  // code...
  $labelsFact[] = $value['mesAno'];
  $dataFact[] = Yii::$app->formatter->asDecimal($value['total']);
}

var_dump($dataFact);exit();



$dataProf = ['0.00'];
$labelsProf = [date('Y')];

foreach ($ventasProformas as $key => $value) {
  // code...
  $labelsProf[] = $value['mesAno'];
  $dataProf[] = Yii::$app->formatter->asDecimal($value['total']);
}


echo   $this->render('//site/_modalForm',[]);

$this->registerJs("
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //--------------
  //- AREA CHART -
  //--------------

  // Get context with jQuery - using jQuery's .get() method.
  var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
  // This will get the first returned node in the jQuery collection.
  var areaChart       = new Chart(areaChartCanvas)

  var areaChartData = {
    labels  : ". json_encode($labelsFact) .",
    datasets: [
      {
        label               : 'Ventas facturadas',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(255,255,255,1)',
        data                : ". json_encode($dataFact)."
      },
      {
        label               : 'Ventas proformas',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : ". json_encode($dataProf)."
      },
      {
        label               : 'Notas de crédito facturas FNC',
        fillColor           : '#3af1a9c7',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3af1a9c7',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : ". json_encode($dataFNC)."
      },
      {
        label               : 'Notas de crédito Boletas BNC',
        fillColor           : 'rgba(255,255,255,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : 'rgba(255,255,255,0.9)',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : ". json_encode($dataBNC)."
      },
    ]
  }

  var areaChartOptions = {
    //Boolean - If we should show the scale at all
    showScale               : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - Whether the line is curved between points
    bezierCurve             : true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot                : false,
    //Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 2,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    //String - A legend template
    legendTemplate          : '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  }

  //Create the line chart
  areaChart.Line(areaChartData, areaChartOptions)
");

$this->registerCss('
.img{
  margin:10px auto;
  border-radius:5px;
  padding:13px;
  width: 100%;
  background:url('. Url::to([ '@web/' .  SiteController::getEmpresa()->image_empresa]) .');
  height: 220px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
  position: relative;
}

@media all and (min-width: 500px) and (max-width: 1000px)
{
.img{
  margin:10px auto;
  border-radius:5px;
  padding:13px;
  width: 100%;
  background:url('. Url::to([ '@web/' .  SiteController::getEmpresa()->image_empresa]) .');
  height: 140px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
  position: relative;
  }
}
');
