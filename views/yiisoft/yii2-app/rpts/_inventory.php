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


/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('rpts', 'Inventory');
$this->params['breadcrumbs'][] = $this->title;
$status = [ 2 => 'DOCUMENTO GENERADO', 3 => 'DOCUMENTO ANULADO'];
$primerDiaMes = date('01/MM/yyyy'); // hard-coded '01' for first day
$ultimoDiaMes  = date('dd/MM/yyyy');
?>
<div class="documento-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid', 'timeout' => 3000]); ?>

    <p><?php // echo $this->render('_searchKardex', ['model' => $searchModel]); ?></p>


    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'pjax' => true,
                'columns' => [
                          [
                            'attribute' => 'cod_prod',
                          ],
                          [
                            'attribute' => 'des_prod',
                          ],
                          [
                            'attribute' => 'stock_total',
                          ],
                          [
                            'attribute' => 'stock_asignado',
                          ],
                          [
                            'attribute' => 'stock_disponible',
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
