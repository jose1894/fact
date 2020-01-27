<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TipomovimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tipo_movimiento', 'Movement type');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-movimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin([ 'id' => 'grid']); ?>

    <p>
        <?= Html::a(Yii::t('tipo_movimiento', 'Create movement type'), ['create','asDialog' => 1 ], [ 'id' => 'create','class' => 'btn btn-flat btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'id_tipom',
              'width' => '5%'
            ],
            'des_tipom',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status_tipom',
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
                                    'id' => $model->id_tipom,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_tipom,
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
                                      'title' => Yii::t('tipo_movimiento', 'Movement type'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_tipom
                                  ],
                      ]);
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                      $url = Url::to(['tipo-movimiento/view','id'=>$model->id_tipom]);
                      return $url;
                  }

                  if ($action === 'update') {
                      $url = Url::to(['tipo-movimiento/update','id'=>$model->id_tipom]);
                      return $url;
                  }
                  if ($action === 'delete') {
                      $url = Url::to(['tipo-movimiento/delete','id'=>$model->id_tipom]);
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
