<?php

use yii\helpers\Html;
use yii\web\View ;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('ingreso', 'Update entry note: {number}', [
    'number' => $model->codigo_trans,
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
        <?php
          $disabled = "disabled";
          if ( $model->status_trans === $model::STATUS_UNAPPROVED ) {
            $disabled = "";
          }
        ?>
        <button id="aprobar-ingreso" class="btn btn-flat btn-warning" <?=$disabled?>><i class="fa fa-check"></i> <?= Yii::t('app','Approve') ?></button>
        <button id="anular-ingreso" class="btn btn-flat btn-danger" <?=$disabled?>><i class="fa fa-ban"></i> <?= Yii::t('app','Cancel') ?></button>
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
          swal(data.title, data.message, data.type);
          return;
      }
    });
  });
";
$this->registerJs($js,View::POS_LOAD);
