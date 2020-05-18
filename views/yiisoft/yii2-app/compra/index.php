<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Proveedor;
use app\models\Vendedor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('compra', 'Purchase order');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin([ 'id' => 'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('compra', 'Create purchase order'), ['create'], ['class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'cod_compra',
              'width' => '10%'
            ],
            [
              'attribute'=>'fecha_compra',
              'value' => function($data){
                   return Yii::$app->formatter->asDate($data->fecha_compra, 'dd/MM/yyyy');
              },
              'width' => '10%'
            ],
            [
                'attribute' => 'nrodoc_compra',
                'width' => '10%',
            ],
            [
              'attribute'=>'provee_compra',
              'value' => function($data){
                   return $data->proveeCompra->nombre_prove;
              },
              'filter'=>Proveedor::getProveedorList(),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '60%'
            ],
            //'condp_compra',
            //'usuario_compra',
            //'estatus_compra',
            //'edicion_compra',
            //'nrodoc_compra',
            //'sucursal_compra',

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
                                    'id' => $model->id_compra,
                                  ]
                      ]);
                  },
                  'view' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                  'title' => Yii::t('app', 'View'),
                                  'class' => 'pjax-view',
                                  'data' => [
                                    'id' => $model->id_compra,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return ($model->estatus_compra == 0 ) ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  // 'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_compra,
                                  ]
                      ]) : '' ;
                  },
                  'delete' => function ($url, $model) {
                      return ($model->estatus_compra == 0 ) ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                  'title' => Yii::t('app', 'Delete'),
                                  'class' => 'pjax-delete',
                                  'data' => [
                                      'message' => Yii::t('app','Are you sure you want to delete this item?'),
                                      'succmessage' => Yii::t('app', 'Item deleted successfully!'),
                                      'method' => 'post',
                                      'pjax' => 0,
                                      'icon' => 'warning',
                                      'title' => Yii::t('compra', 'Purchase order'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_compra
                                  ],
                      ]) : '';
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'print') {
                        $url = Url::to(['compra/compra-rpt','id' => $model->id_compra]);

                        return $url;
                    }
                    if ($action === 'view') {
                        $url = Url::to(['compra/view','id' => $model->id_compra, 'asDialog' => true]);
                        return $url;
                    }
                    if ($action === 'update') {
                        $url = Url::to(['compra/update','id' => $model->id_compra]);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = Url::to(['compra/delete','id' => $model->id_compra]);
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
//Maestro
$this->registerJsVar( "buttonCreate", "#create" );
$this->registerJsVar( "buttonSubmit", "#submit" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
//Detalles
echo   $this->render('//site/_modalForm',[]);

$this->registerJsVar( "buttonPrint", ".pjax-print" );
$this->registerJsVar( "frameRpt", "#frame-rpt" );
$this->registerJsVar( "modalRpt", "#modal-rpt" );
echo   $this->render('//site/_modalRpt',[]);
