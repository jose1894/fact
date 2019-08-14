<?php

use yii\helpers\Html;
use yii\web\View ;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('ingreso', 'Update entry note: {number}', [
    'number' => $model->id_trans,
    //'name' => $model->nombre_trans,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('ingreso', 'Entry note'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trans, 'url' => ['view', 'id' => $model->id_trans]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedido-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
      <span style="float:right">
        <a href="#" id="aprobar-ingreso" class="btn btn-flat btn-warning"><i class="fa fa-check"></i> <?= Yii::t('app','Approve') ?></a>
        <a href="#" id="anular-ingreso" class="btn btn-flat btn-danger"><i class="fa fa-ban"></i> <?= Yii::t('app','Cancel') ?></a>
      </span>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalles' => $modelsDetalles,
    ]) ?>
    </div>
  </div>
</div>
<?php
$js = "
  $( '#aprobar-ingreso' ).on('click', function(){
    form = $('.pedido-update form');

    $.ajax({
      'url': '".Url::to(['nota-ingreso/aprobar-nota'])."',
      'method': $( form ).attr( 'method' ),
      'data'   : $( form ).serialize(),
      'async'  : false,
      'success': function ( data ){

        if ( data.success ) {
          swal(data.title, data.message, data.type);
          return;
        } else {
          swal(data.title, data.message, data.type);
          return;          
        }

      }
    });
  });
";
$this->registerJs($js,View::POS_LOAD);
