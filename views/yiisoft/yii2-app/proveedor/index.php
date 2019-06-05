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
/* @var $searchModel app\models\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('proveedor', 'Supplier');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id'=>'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('proveedor', 'Create supplier'), ['create', 'asDialog' => 1], ['id' => 'create', 'class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
               'attribute' => 'id_prove',
               'width' => '5%',
            ],
            'dni_prove',
            'ruc_prove',
            [
              'attribute' => 'nombre_prove',
              'format' => 'raw',
              'contentOptions' => ['class' => 'text-wrap'],
              'width' => '50%'
            ],
            [
              'attribute'=>'provi_prove',
              'value' => function($data){
                   return $data->proviProve->des_prov;
              },
              'filter'=>$searchModel->pais_prove,
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
                'attribute' => 'status_prove',
                'vAlign' => 'middle',
                'width' => '10%',
                'trueLabel' => 'Yes',
                'falseLabel' => 'No '
            ],
            //'direcc_prove:ntext',
            //'pais_prove',
            //'depto_prove',
            //'provi_prove',
            //'dtto_prove',
            //'tlf_prove',
            //'tipo_prove',
            //'status_prove',
            //'sucursal_prove',

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
                                    'id' => $model->id_prove,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_prove,
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
                                      'title' => Yii::t('proveedor', 'Supplier'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_prove
                                  ],
                      ]);
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                      $url ='index.php?r=proveedor/view&id='.$model->id_prove.'&asDialog=1';
                      return $url;
                  }

                  if ($action === 'update') {
                      $url ='index.php?r=proveedor/update&id='.$model->id_prove."&asDialog=1";
                      return $url;
                  }
                  if ($action === 'delete') {
                      $url ='index.php?r=proveedor/delete&id='.$model->id_prove;
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
