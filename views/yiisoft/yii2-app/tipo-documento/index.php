<?php


use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipodocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tipo_documento', 'Document type');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin([ 'id' => 'grid']); ?>

    <p>
        <?= Html::a(Yii::t('tipo_documento', 'Create document type'), ['create','asDialog' => 1 ], [ 'id' => 'create','class' => 'btn btn-flat btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'id_tipod',
              'width' => '5%'
            ],
            'des_tipod',
            [
              'attribute'=>'tipodsunat_tipod',
              'width' => '7%'
            ],
            [
              'attribute'=>'abrv_tipod',
              'width' => '7%'
            ],
            [
              'attribute'=>'ope_tipod',
              'value' => function($data){
                   $operacion =  ['E' => 'Entrada', 'S' => 'Salida', 'N' => 'Ninguno'];
                   return $operacion[ $data->ope_tipod ];
              },
              //'filter'=>TipoMovimiento::getTipoMovList( 'E' ),
              'filter'=> ['E' => 'Entrada', 'S' => 'Salida', 'N' => 'Ninguno'],
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
              'width' => '10%',
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status_tipod',
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
                                    'id' => $model->id_tipod,
                                  ]
                      ]);
                  },

                  'update' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                  'title' => Yii::t('app', 'Update'),
                                  'class' => 'pjax-update',
                                  'data' => [
                                    'id' => $model->id_tipod,
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
                                      'title' => Yii::t('tipo_documento', 'Document type'),
                                      'ok' => Yii::t('app', 'Confirm'),
                                      'cancel' => Yii::t('app', 'Cancel'),
                                      'id' => $model->id_tipod
                                  ],
                      ]);
                  }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                      $url = Url::to(['tipo-documento/view','id'=>$model->id_tipod]);
                      return $url;
                  }

                  if ($action === 'update') {
                      $url = Url::to(['tipo-documento/update','id'=>$model->id_tipod]);
                      return $url;
                  }
                  if ($action === 'delete') {
                      $url = Url::to(['tipo-documento/delete','id'=>$model->id_tipod]);
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
