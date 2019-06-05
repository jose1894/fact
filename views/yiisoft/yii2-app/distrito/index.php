<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use app\models\Provincia;
use app\models\Departamento;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DistritoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('distrito', 'District / Parish');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distrito-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id'=>'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('distrito', 'Create district / parish'), ['create' ,'asDialog'=>1], ['id'=>'create','class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'id_dtto',
              'width' => '5%'
            ],
            [
              'attribute'=>'des_dtto',
              'width' => '20%'
            ],
            [
              'attribute'=>'pais_dtto',
              'value' => function($data){
                   return $data->paisDtto->des_pais;
              },
              'filter'=>ArrayHelper::map(Pais::find()->where(['status_pais' => 1])->orderBy(['des_pais'=>SORT_ASC])->asArray()->all(), 'id_pais', 'des_pais'),
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
              'attribute'=>'prov_dtto',
              'value' => function($data){
                   return $data->provDtto->des_prov;
              },
              'filter'=>ArrayHelper::map(Provincia::find()->where(['pais_prov' => $searchModel->pais_dtto,'status_prov' => 1])->asArray()->all(), 'id_prov', 'des_prov'),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '10%'
            ],
            [
              'attribute'=>'depto_dtto',
              'value' => function($data){
                   return $data->deptoDtto->des_depto;
              },
              'filter'=>ArrayHelper::map(Departamento::find()->where(['pais_depto' => $searchModel->pais_dtto,'prov_depto' => $searchModel->prov_dtto,'status_depto' => 1])->asArray()->all(), 'id_depto', 'des_depto'),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '5%'
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status_dtto',
                'vAlign' => 'middle',
                'width' => '10%'
            ],
            //'sucursal_dtto',
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
                                  'id' => $model->id_dtto,
                                ]
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'pjax-update',
                                'data' => [
                                  'id' => $model->id_dtto,
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
                                    'title' => Yii::t('distrito', 'District / Parish'),
                                    'ok' => Yii::t('app', 'Confirm'),
                                    'cancel' => Yii::t('app', 'Cancel'),
                                    'id' => $model->id_dtto
                                ],
                    ]);
                }

              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='index.php?r=distrito/view&id='.$model->id_dtto.'&asDialog=1';
                    return $url;
                }

                if ($action === 'update') {
                    $url ='index.php?r=distrito/update&id='.$model->id_dtto."&asDialog=1";
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='index.php?r=distrito/delete&id='.$model->id_dtto;
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
