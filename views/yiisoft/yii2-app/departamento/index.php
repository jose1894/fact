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
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('departamento', 'Estate / Department');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid']); ?>
    <p>
        <?= Html::a(Yii::t('departamento', 'Create estate / department'), ['create', 'asDialog' => 1], ['id'=>'create','class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'id_depto',
              'width' => '5%'
            ],
            [
              'attribute'=>'cod_depto',
              'width' => '5%'
            ],
            'des_depto',
            [
              'attribute'=>'pais_depto',
              'value' => function($data){
                   return $data->paisDepto->des_pais;
              },
              'filter'=>Pais::getPaisList(),
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
                'attribute' => 'status_depto',
                'vAlign' => 'middle',
                'width' => '10%'
            ],
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
                                  'id' => $model->id_depto,
                                ]
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'pjax-update',
                                'data' => [
                                  'id' => $model->id_depto,
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
                                    'title' => Yii::t('departamento', 'Estate / Department'),
                                    'ok' => Yii::t('app', 'Confirm'),
                                    'cancel' => Yii::t('app', 'Cancel'),
                                    'id' => $model->id_depto
                                ],
                    ]);
                }

              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url = Url::to(['departamento/view', 'id' => $model->id_depto]);
                    return $url;
                }

                if ($action === 'update') {
                    $url = Url::to(['departamento/update', 'id' => $model->id_depto]);
                    return $url;
                }
                if ($action === 'delete') {
                    $url = Url::to(['departamento/delete', 'id' => $model->id_depto]);
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
