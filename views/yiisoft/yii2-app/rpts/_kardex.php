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

$this->title = Yii::t('app', 'Product movement');
$this->params['breadcrumbs'][] = $this->title;
$status = [ 2 => 'DOCUMENTO GENERADO', 3 => 'DOCUMENTO ANULADO'];
$primerDiaMes = date('01/MM/yyyy'); // hard-coded '01' for first day
$ultimoDiaMes  = date('dd/MM/yyyy');
$this->registerCss(".kv-grid-table{ width: 1600px !important; }");
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid']); ?>

    <p><?php  echo $this->render('_searchKardex', ['model' => $searchModel]); ?></p>

    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'responsive' => true,
                // 'responsiveWrap' => false,
                // 'floatHeader' => true,
                // 'floatHeaderOptions' => [
                //     'scrollingTop' => '0',
                //     'position' => 'absolute',
                // ],
                'perfectScrollbar' => true,
                'floatOverflowContainer' => true,
                'columns' => [
                          [
                            'attribute' => 'fecha_trans',
                            'format' => ['date', 'php:d/m/Y']
                          ],
                          'docref_trans',
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
                            'attribute' => 'ingreso_unidades',
                            'label' => 'Ingreso',
                            'width' => '5%'
                          ],
                          'moneda',
                          [
                            'attribute' => 'precio_compra_ext',
                            'label' => 'P.Compra$',
                            'width' => '5%'
                          ],
                          [
                            'attribute' => 'precio_compra_soles',
                            'label' => 'P.Compra/S',
                            'width' => '5%'
                          ],
                          [
                            'attribute' => 'ingreso_valorizados',
                            'label' => 'I.Valorizados',
                          ],
                          [
                            'attribute' => 'salidas_unidades',
                            'value' => function( $data ) {
                                return (-1 * $data['salidas_unidades']);
                            },
                            'label' => 'Salidas',
                            'width' => '5%'
                          ],
                  ]
              ]) ?>
