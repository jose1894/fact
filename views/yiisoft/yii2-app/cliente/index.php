<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use yii\helpers\ArrayHelper;
use app\models\Provincia;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cliente', 'Customer');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id'=>'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('cliente', 'Create customer'), ['create','asDialog' => 1], ['id'=>'create', 'class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
               'attribute' => 'id_clte',
               'width' => '5%',
            ],
            'dni_clte',
            'ruc_clte',
            [
              'attribute' => 'nombre_clte',
              'format' => 'raw',
              'contentOptions' => ['class' => 'text-wrap'],
              'width' => '50%'
            ],
            //'vendedor_clte',
            [
              'attribute'=>'provi_cte',
              'value' => function($data){
                   return $data->provClte->des_prov;
              },
              'filter'=>$searchModel->pais_cte,
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
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'estatus_ctle',
                'vAlign' => 'middle',
                'width' => '10%'
            ],
            //'direcc_clte:ntext',
            //'depto_cte',
            //'provi_cte',
            //'dtto_clte',
            //'tlf_ctle',
            //'estatus_ctle',
            //'condp_clte',
            //'sucursal_clte',

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
                                    'id' => $model->id_clte,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_clte,
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
                                      'title' => Yii::t('cliente', 'Customer'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_clte
                                  ],
                      ]);
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                      $url ='index.php?r=cliente/view&id='.$model->id_clte.'&asDialog=1';
                      return $url;
                  }

                  if ($action === 'update') {
                      $url ='index.php?r=cliente/update&id='.$model->id_clte."&asDialog=1";
                      return $url;
                  }
                  if ($action === 'delete') {
                      $url ='index.php?r=cliente/delete&id='.$model->id_clte;
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
