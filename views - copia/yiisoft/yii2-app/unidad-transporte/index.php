<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UnidadTransporteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('unidad_transporte', 'Transport unit');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-transporte-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin([ 'id' => 'grid']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('unidad_transporte', 'Create transport unit'), ['create'], ['id' => 'create','class' => 'btn-flat btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          [
            'attribute'=>'id_utransp',
            'width' => '5%'
          ],
          'des_utransp',
          [
              'class' => 'kartik\grid\BooleanColumn',
              'attribute' => 'status_utransp',
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
                                  'id' => $model->id_utransp,
                                ]
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'pjax-update',
                                'data' => [
                                  'id' => $model->id_utransp,
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
                                    'title' => Yii::t('unidad_transporte', 'Transport unit'),
                                    'ok' => Yii::t('app', 'Confirm'),
                                    'cancel' => Yii::t('app', 'Cancel'),
                                    'id' => $model->id_utransp
                                ],
                    ]);
                }

              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url = Url::to(['unidad-transporte/view','id'=>$model->id_utransp]);
                    return $url;
                }

                if ($action === 'update') {
                    $url = Url::to(['unidad-transporte/update','id'=>$model->id_utransp]);
                    return $url;
                }
                if ($action === 'delete') {
                  $url = Url::to(['unidad-transporte/delete','id'=>$model->id_utransp]);
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
