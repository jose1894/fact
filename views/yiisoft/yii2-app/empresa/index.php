<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
           'neverTimeout'=>true,
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<div class="modal fade" id="modal" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <iframe src="" id="frame" width="100%" height="600" frameBorder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-flat btn-danger pull-left" data-dismiss="modal"><span class="fa fa-remove"></span> <?= Yii::t('app','Close')?></button>
        <button id="submit" type="button" class="btn btn-flat btn-success"><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
$this->registerJsVar( "buttonCreate", "#create" );
$this->registerJsVar( "buttonSubmit", "#submit" );
$this->registerJsVar( "buttonCancel", "#cancel" );
$this->registerJsVar( "frame", "#frame" );
$this->registerJsVar( "modal", "#modal" );

$this->registerJs( <<<JS
  $( buttonCreate ).on('click', function ( e ) {
    e.preventDefault();
    $( frame ).attr( "src", $( this ).attr( 'href' ));
    $( modal ).modal({
      backdrop: 'static',
      keyboard: false
    });
    $( modal ).modal("show");
  });

  $( buttonSubmit ).on( 'click', function(){
    $( frame ).contents().find('form').submit();
  });

  $( buttonCancel ).on( 'click', function(){
    $( modal ).modal("hide");
  });

JS
, View::POS_END);
