<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Cliente;
use app\models\Vendedor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
// use app\models\Provincia;
// use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('pedido', 'Purchase order');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('pedido', 'Create purchase order'), ['create'], ['class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'cod_pedido',
              'width' => '5%'
            ],
            [
              'attribute'=>'fecha_pedido',
              'value' => function($data){
                   return Yii::$app->formatter->asDate($data->fecha_pedido, 'dd/MM/yyyy');
              },
              'width' => '7%'
            ],
            [
              'attribute'=>'clte_pedido',
              'value' => function($data){
                   return $data->cltePedido->nombre_clte;
              },
              'filter'=>ArrayHelper::map(Cliente::find()->where(['estatus_ctle' => 1])->orderBy(['nombre_clte'=>SORT_ASC])->asArray()->all(), 'id_clte', 'nombre_clte'),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '65%'
            ],
            [
              'attribute'=>'vend_pedido',
              'value' => function($data){
                   return $data->vendPedido->nombre_vend;
              },
              'filter'=>ArrayHelper::map(Vendedor::find()->where(['estatus_vend' => 1])->orderBy(['nombre_vend'=>SORT_ASC])->asArray()->all(), 'id_vendedor', 'nombre_vend'),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '20%'
            ],
            //'moneda_pedido',
            //'almacen_pedido',
            //'usuario_pedido',
            //'estatus_pedido',
            //'sucursal_pedido',

            [
                'class' => '\kartik\grid\ActionColumn',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                  'view' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                  'title' => Yii::t('app', 'View'),
                                  'class' => 'pjax-view',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  // 'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_pedido,
                                  ]
                      ]);
                  },
                  'delete' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                  'title' => Yii::t('app', 'Delete'),
                                  'class' => 'pjax-delete',
                                  'data' => [
                                      'message' => Yii::t('app','Are you sure you want to delete this item?'),
                                      'succmessage' => Yii::t('app', 'Item deleted successfully!'),
                                      'method' => 'post',
                                      'pjax' => 0,
                                      'icon' => 'warning',
                                      'title' => Yii::t('pedido', 'Order'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_pedido
                                  ],
                      ]);
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                      $url ='index.php?r=pedido/view&id='.$model->id_pedido.'&asDialog=1';
                      return $url;
                  }

                  if ($action === 'update') {
                      $url ='index.php?r=pedido/update&id='.$model->id_pedido;
                      return $url;
                  }
                  if ($action === 'delete') {
                      $url ='index.php?r=pedido/delete&id='.$model->id_pedido;
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
$this->registerJsVar( "frame", "#framePedido" );
$this->registerJsVar( "modal", "#modal" );
//Detalles
$this->registerJsVar( "buttonCreate_detail", "#add-detalle" );
$this->registerJsVar( "buttonSubmit_detail", "#submit-detail" );
$this->registerJsVar( "buttonCancel_detail", ".close-detail-btn" );
$this->registerJsVar( "frame_detail", "#frame-detail" );
$this->registerJsVar( "modal_detail", "#modal-detail" );
echo   $this->render('//site/_modalPedido',[]);
$this->registerJsFile(
    '@web/js/app-detail.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
