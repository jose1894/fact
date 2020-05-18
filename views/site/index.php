<?php
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\web\View;
use antishov\Morris;
use yii\web\JsExpression;
use app\models\PedidoSearch;
use app\models\DocumentoSearch;
use app\models\CompraSearch;
use app\models\User;

$this->title = 'Resumen';

//echo "ak";
// echo Helper::checkRoute('/empresa/create');

?>
<div class="site-index">

        <section class="content">
          <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3><?php
                      $model = PedidoSearch::showCountPedidos();
                      echo count($model->query);
                      ?></h3>

                    <p><?= Yii::t('pedido', 'New orders')?></p>
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
                      echo count($model->query);
                      ?></h3>

                    <p><?= Yii::t('documento', 'Invoices')?></p>
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
                      echo count($model->query);
                      ?></h3>

                    <p><?= Yii::t('compra', 'Purchase order')?></p>
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
        			<section class="col-lg-12 connectedSortable">
        			  <!-- Custom tabs (Charts with tabs)-->
        			  <div class="nav-tabs-custom">
        				<!-- Tabs within a box -->
        				<ul class="nav nav-tabs pull-right">
        				  <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
        				  <li class="pull-left header"><i class="fa fa-inbox"></i> Ventas (Datos demo)</li>
        				</ul>
        				<div class="tab-content no-padding">
        				  <!-- Morris chart - Sales -->
        				  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
        				</div>
        			  </div>
        			  <!-- /.nav-tabs-custom -->
        			</section>
        	  </div>

	  <div class="row" style="display:none">

	  <?= Morris\Line::widget([
     'resize' => true,
     'gridTextSize' => 11,
     'element' => 'lineChart',
     'data' => [
         ['date' => '2017-06-14', 'value' => 2],
         ['date' => '2017-06-15', 'value' => 4],
         ['date' => '2017-06-16', 'value' => 1]
     ],
     'xKey' => 'date',
     'yKeys' => ['value'],
     'labels' => ['Impressions'],
     'xLabels' => 'day',
     'yLabelFormat' => new JsExpression(
         'function (y) {if (y === parseInt(y, 10)) {return y;}else {return "";}}'
     ),
     'yMin' => 'auto 40',
     'lineColors' => ['rgb(123, 204, 221)'],
     'pointFillColors' => ['rgb(82, 188, 211)'],
 ]); ?>
	  </div>
</div>




<?php
echo   $this->render('//site/_modalForm',[]);
$js = "
  /* Morris.js Charts */
  // Sales chart
  var area = new Morris.Area({
    element   : 'revenue-chart',
    resize    : true,
    data      : [
      { y: '2011 Q1', item1: 2666, item2: 2666 },
      { y: '2011 Q2', item1: 2778, item2: 2294 },
      { y: '2011 Q3', item1: 4912, item2: 1969 },
      { y: '2011 Q4', item1: 3767, item2: 3597 },
      { y: '2012 Q1', item1: 6810, item2: 1914 },
      { y: '2012 Q2', item1: 5670, item2: 4293 },
      { y: '2012 Q3', item1: 4820, item2: 3795 },
      { y: '2012 Q4', item1: 15073, item2: 5967 },
      { y: '2013 Q1', item1: 10687, item2: 4460 },
      { y: '2013 Q2', item1: 8432, item2: 5713 }
    ],
    xkey      : 'y',
    ykeys     : ['item1', 'item2'],
    labels    : ['Item 1', 'Item 2'],
    lineColors: ['#a0d0e0', '#3c8dbc'],
    hideHover : 'auto'
  });
  var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });";

  $this->registerJs($js, View::POS_LOAD);
