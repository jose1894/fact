<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

JqueryAsset::register($this);
$this->title = Yii::t('empresa', 'Empresas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin( ['id'=> "grid"] ); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('empresa', 'Create company'), ['create', 'asDialog' => 1 ], [ 'id' => 'create', 'class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id_empresa',
            [
              'attribute' => 'nombre_empresa',
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'estatus_empresa',
                'vAlign' => 'middle'
            ],
            //'dni_empresa',
            //'ruc_empresa',
            //'tipopers_empresa',
            //'tlf_empresa',
            //'direcc_empresa:ntext',

            [
              'class' => '\kartik\grid\ActionColumn',
              'headerOptions' => ['style' => 'color:#337ab7'],
              'template' => '{view} {update} {delete}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'View'),
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'pjax-update',
                                'data' => [
                                  'url' => $url,
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
                                    'url' => $url,
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
                    $url ='index.php?r=empresa/view&id='.$model->id_empresa.'&asDialog=1';
                    return $url;
                }

                if ($action === 'update') {
                    $url ='index.php?r=empresa/update&id='.$model->id_empresa."&asDialog=1";
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='index.php?r=empresa/delete&id='.$model->id_empresa;
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
$this->registerJsVar( "buttonCancel", "#cancel" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );
echo   $this->render('_modalForm',[]);
