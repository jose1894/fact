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
$this->params['breadcrumbs'][] = ['label' => $model->codigo_trans];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="nota-ingreso-update">
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
        <button id="aprobar-ingreso" class="btn btn-flat btn-primary" <?=$disabled?>><i class="fa fa-check"></i> <?= Yii::t('app','Approve') ?></button>
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
$js = '
  $( "#aprobar-ingreso" ).on("click", function(){
    form = $(".nota-ingreso-update form");
    swal({
      title: "' . Yii::t( 'ingreso', 'Entry note') . '",
      text: "' . Yii::t( 'ingreso','Do you want to approve the entry note?') . '",
      icon: "warning",
      buttons: true,
    }).then( ( willDelete ) => {
      if ( willDelete ) {
        $.ajax({
          "url": "'.Url::to(['nota-ingreso/aprobar-nota']).'",
          "method": $( form ).attr( "method" ),
          "data"   : $( form ).serialize(),
          "async"  : false,
          "success": function ( data ){
              swal(data.title, data.message, data.type);
              $(".nota-ingreso-update .btn").attr("disabled",true);
              $(".nota-ingreso-update input").attr("disabled",true);
              $(".nota-ingreso-update textarea").attr("disabled",true);
              $(".nota-ingreso-update select").prop("disabled",true);
              $(".nota-ingreso-update #imprimir").attr("disabled",false);
              return;
          }
        });
      }
    });

  });

  $( "#anular-ingreso" ).on("click", function(){
    form = $(".nota-ingreso-update form");

    swal({
      title: "' . Yii::t( 'ingreso', 'Entry note') . '",
      text: "' . Yii::t( 'ingreso','Do you want to cancel the entry note?') . '",
      icon: "warning",
      buttons: true,
    }).then( ( willDelete ) => {
      if ( willDelete ) {
        $.ajax({
          "url": "'.Url::to(["nota-ingreso/anular-nota"]).'",
          "method": $( form ).attr( "method" ),
          "data"   : $( form ).serialize(),
          "async"  : false,
          "success": function ( data ){
            $(".nota-ingreso-update input").attr("disabled",true);
            $(".nota-ingreso-update textarea").attr("disabled",true);
            $(".nota-ingreso-update button").attr("disabled",true);
            $(".nota-ingreso-update select").prop("disabled",true);
            $(".nota-ingreso-update #imprimir").attr("disabled",false);
            swal(data.title, data.message, data.type);

            return true;

          }
        });

      }
    });


  });
';
$this->registerJs($js,View::POS_LOAD);
