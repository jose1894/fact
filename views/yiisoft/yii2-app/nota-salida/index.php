<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Proveedor;
use app\models\Vendedor;
use app\models\TipoMovimiento;
use app\models\NotaSalida;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NotasalidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('salida', 'Exit note');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nota-salida-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid', 'timeout' => 3000]); ?>

    <p>
        <?= Html::a(Yii::t('salida', 'Create exit note'), ['create'], ['class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'codigo_trans',
              'width' => '7%'
            ],
            [
              'attribute'=>'fecha_trans',
              'format' => ['date', 'php:d/m/Y'],
              'filterType' => GridView::FILTER_DATE_RANGE,
              'filterWidgetOptions' => ([
                  'useWithAddon'=>true,
                  'presetDropdown'=>true,
                  'convertFormat'=>true,
                  'includeMonthsFilter'=>true,
                  'pluginOptions' => [
                        'locale' => ['format' => 'd/m/Y'],
                        'maxDate' => date('d/m/Y'),
                        'showDropdowns'=>true
                  ],
                  'options' => ['placeholder' => Yii::t( 'app', 'Select range' )."..." ],
                ])
            ],
            [
              'attribute'=>'docref_trans',
              'width' => '10%'
            ],
            //'tipo_trans',
            [
              'attribute'=>'tipo_trans',
              'value' => function($data){
                   return $data->tipoTrans->des_tipom;
              },
              'filter'=>TipoMovimiento::getTipoMovList( 'S' ),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],

            ],
            [
              'attribute'=>'status_trans',
              'value' => function($data){
                   $status =  NotaSalida::getStatuses();
                   return $status[ $data->status_trans ];
              },
              //'filter'=>TipoMovimiento::getTipoMovList( 'E' ),
              'filter'=> NotaSalida::getStatuses(),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '10%',
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{print}&nbsp;&nbsp;&nbsp;{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
                'buttons' => [
                  'print' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [
                                  'title' => Yii::t('app', 'Print'),
                                  'class' => 'pjax-print',
                                  'data' => [
                                    'id' => $model->id_trans,
                                  ]
                      ]);
                  },
                  'view' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                  'title' => Yii::t('app', 'View'),
                                  'class' => 'pjax-view',
                                  'data' => [
                                    'id' => $model->id_trans,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return !$model->status_trans ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  //'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_trans,
                                  ]
                      ]) : '';
                  },
                  'delete' => function ($url, $model) {
                      return !$model->status_trans ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                  'title' => Yii::t('app', 'Delete'),
                                  'class' => 'pjax-delete',
                                  'data' => [
                                      'message' => Yii::t('app','Are you sure you want to delete this item?'),
                                      'succmessage' => Yii::t('app', 'Item deleted successfully!'),
                                      'method' => 'post',
                                      'pjax' => 0,
                                      'icon' => 'warning',
                                      'title' => Yii::t('salida', 'Exit note'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_trans
                                  ],
                      ]) : '';
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'print') {
                      $url = Url::to(['nota-salida/notas-rpt','id'=>$model->id_trans]);
                      return $url;
                  }

                  if ($action === 'view') {
                      $url = Url::to(['nota-salida/view','id' => $model->id_trans]);
                      return $url;
                  }

                  if ($action === 'update') {
                      $url = Url::to(['nota-salida/update','id' => $model->id_trans]);
                      return $url;
                  }
                  if ($action === 'delete') {
                      $url = Url::to(['nota-salida/delete','id' => $model->id_trans]);
                      return $url;
                  }

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
$this->registerJsVar( "buttonCreate", "#create" );
$this->registerJsVar( "buttonSubmit", "#submit" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
echo   $this->render('//site/_modalForm',[]);

$this->registerJsVar( "buttonPrint", ".pjax-print" );
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);
