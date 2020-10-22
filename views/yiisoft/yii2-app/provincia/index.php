<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use yii\helpers\ArrayHelper;
use app\models\Departamento;
use app\models\Pais;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvinciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('provincia', 'Estate / Province');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provincia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid','timeout' => 3000]); ?>

    <p>
        <?= Html::a(Yii::t('provincia', 'Create estate / province'), ['create','asDialog' => 1], [ 'id' => 'create', 'class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'pais',
              'value' => function($data){
                return $data->deptoProv->paisDepto->des_pais;
              },
              'filter'=>Pais::getPaisList(),
              'label' => Yii::t('pais','Country'),
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
              'attribute'=>'depto_prov',
              'value' => function($data){
                return $data->deptoProv->des_depto;
              },
              'filter'=>Departamento::getDeptoList((empty($searchModel->deptoProv->pais_depto)) ? null : $searchModel->deptoProv->pais_depto),
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
              'attribute'=>'id_prov',
              'width' => '5%'
            ],
            'des_prov',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status_prov',
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
                                  'id' => $model->id_prov,
                                ]
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'pjax-update',
                                'data' => [
                                  'id' => $model->id_prov,
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
                                    'title' => Yii::t('provincia', 'Estate / Province'),
                                    'ok' => Yii::t('app', 'Confirm'),
                                    'cancel' => Yii::t('app', 'Cancel'),
                                    'id' => $model->id_prov
                                ],
                    ]);
                }

              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url = Url::to(['provincia/view','id'=>$model->id_prov]);
                    return $url;
                }

                if ($action === 'update') {
                    $url = Url::to(['provincia/update','id'=>$model->id_prov]);
                    return $url;
                }
                if ($action === 'delete') {
                    $url = Url::to(['provincia/delete','id'=>$model->id_prov]);
                    return $url;
                }

              }
            ],
        ],
        'pjax'=>true,
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
