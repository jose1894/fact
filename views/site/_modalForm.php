<?php
use yii\web\View;
use yii\helpers\Url;
?>
<div class="modal modal-wide fade" id="modal" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-btn" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <iframe src="" id="frame" width="100%" height="600" frameBorder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-flat btn-danger pull-left close-btn"><span class="fa fa-remove"></span> <?= Yii::t('app','Close')?></button>
        <button id="submit" type="button" class="btn btn-flat btn-success"><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-detail" style="display: none;">
  <div class="modal-dialog modal-lg modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-detail-btn" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <iframe src="" id="frame-detail" width="100%" height="300" frameBorder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-flat btn-danger pull-left close-detail-btn"><span class="fa fa-remove"></span> <?= Yii::t('app','Close')?></button>
        <button id="submit-detail" type="button" class="btn btn-flat btn-success"><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal tipo cambio -->
<div class="modal modal-warning fade" id="modal-tipoc" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <?= Yii::t('tipo_cambio', 'Exchange') ?>
        <button type="button" class="close close-btn" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="" id="frame-tipoc" width="100%" height="600" frameBorder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-flat btn-danger pull-left close-btn"><span class="fa fa-remove"></span> <?= Yii::t('app','Close')?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal tipo cambio -->
<?php
$js = "
  // Consulta si el tipo de cambio ha sido seteado al dia
  $.ajax({
    method:'POST',
    url: '".Url::to(['/tipo-cambio/consulta-tipoc'])."',
    data: {fecha:'".date('Y-m-d')."'},
    success: function( data ){
      data = JSON.parse(data);
      if ( !data.success ) {
        $( '#modal-tipoc' ).modal( 'show' );
        $( '#frame-tipoc' ).prop( 'src', '" . Url::to(['tipo-cambio/diario']) . "')
      }

    }
  });

  $( '.close-btn' ).click( function(){
    $( '#modal-tipoc' ).modal( 'hide' );
  });
";

$this->registerJs($js, View::POS_LOAD);

$this->registerJsFile(
    '@web/js/app.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
