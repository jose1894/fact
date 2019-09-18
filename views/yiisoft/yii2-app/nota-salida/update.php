<?php

use yii\helpers\Html;
use yii\web\View ;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('salida', 'Update exit note: {number}', [
    'number' => $model->codigo_trans,
    //'name' => $model->nombre_trans,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('salida', 'Exit note'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo_trans, 'url' => ['view', 'id' => $model->id_trans]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="nota-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
      <span style="float:right">
        <?php
          $disabled = "disabled";
          if ( $model->status_trans === $model::STATUS_UNAPPROVED ) {
            $disabled = "";
          }
        ?>
        <button id="aprobar-salida" class="btn btn-flat btn-warning" <?=$disabled?>><i class="fa fa-check"></i> <?= Yii::t('app','Approve') ?></button>
        <button id="anular-salida" class="btn btn-flat btn-danger" <?=$disabled?>><i class="fa fa-ban"></i> <?= Yii::t('app','Cancel') ?></button>
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
  $( '#aprobar-salida' ).on('click', function(){
    form = $('.nota-update form');

    $.ajax({
      'url': '".Url::to(['nota-salida/aprobar-nota'])."',
      'method': $( form ).attr( 'method' ),
      'data'   : $( form ).serialize(),
      'async'  : false,
      'success': function ( data ){
        $('.nota-update input').attr('disabled',true);
        $('.nota-update select').attr('disabled',true);
        $('.nota-update textarea').attr('disabled',true);
        $('.nota-update button').attr('disabled',true);
        $('.nota-update #imprimir').attr('disabled',false);
        swal(data.title, data.message, data.type);
        return;

      }
    });
  });

  $( '#anular-salida' ).on('click', function(){
    form = $('.nota-update form');

    $.ajax({
      'url': '".Url::to(['nota-salida/anular-nota'])."',
      'method': $( form ).attr( 'method' ),
      'data'   : $( form ).serialize(),
      'async'  : false,
      'success': function ( data ){
        $('.nota-update input').attr('disabled',true);
        $('.nota-update select').prop('disabled',true);
        $('.nota-update textarea').attr('disabled',true);
        $('.nota-update button').attr('disabled',true);
        $('.nota-update #imprimir').attr('disabled',false);
        swal(data.title, data.message, data.type);



        return;

      }
    });
  });

";
$this->registerJs($js,View::POS_LOAD);
