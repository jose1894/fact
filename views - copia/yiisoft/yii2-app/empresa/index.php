<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

JqueryAsset::register($this);
$this->title = Yii::t('empresa', 'Company');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin( ['id'=> "grid"] ); ?>

    <p>
        <?= Html::a(Yii::t('empresa', 'Create company'), ['create', 'asDialog' => 1 ], [ 'id' => 'create', 'class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'id_empresa',
              'width' => '5%'
            ],
            [
              'attribute' => 'nombre_empresa',
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'estatus_empresa',
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
                                  'id' => $model->id_empresa,
                                ]
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'pjax-update',
                                'data' => [
                                  'id' => $model->id_empresa,
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
                                    'title' => Yii::t('empresa', 'Company'),
                                    'ok' => Yii::t('app', 'Confirm'),
                                    'cancel' => Yii::t('app', 'Cancel'),
                                    'id' => $model->id_empresa
                                ],
                    ]);
                }

              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url = Url::to(['empresa/view', 'id' => $model->id_empresa]);
                    return $url;
                }
                if ($action === 'update') {
                    $url = Url::to(['empresa/update', 'id' => $model->id_empresa]);
                    return $url;
                }
                if ($action === 'delete') {
                    $url = Url::to(['empresa/delete', 'id' => $model->id_empresa]);
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
    ]);
     ?>
    <?php Pjax::end(); ?>
</div>
<?php
$this->registerJsVar( "buttonCreate", "#create" );
$this->registerJsVar( "buttonSubmit", "#submit" );
$this->registerJsVar( "buttonCancel", ".close-btn" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
echo   $this->render('//site/_modalForm',[]);
