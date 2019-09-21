<?php
use yii\web\View;
?>
<div class="modal modal-info fade modal-wide" id="modal-guide" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-btn" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <iframe src="" id="frame-guide" width="100%" height="600" frameBorder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-flat btn-danger pull-left close-btn"><span class="fa fa-remove"></span> <?= Yii::t('app','Close')?></button>
        <button  type="submit" class="btn btn-flat btn-success pull-right " ><span class="fa fa-circle-play"></span> <?= Yii::t('documento','Generate guide')?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
$js = '
  $( "body" ).on("click", buttonGuide, function ( e ) {
    e.preventDefault();
    $( frameGuide ).attr( "src", $( this ).attr( "href" ));
    $( modalGuide ).modal({
      backdrop: "static",
      keyboard: false,
    });
    $( modalGuide ).modal("show");
  });

  $( "body" ).on("click", ".close-btn", function ( e ) {
    e.preventDefault();
    $( "#frame-guide" ).attr( "src", "about:blank" );
    $( "#modal-guide" ).modal("hide");
  });


';

$this->registerJs($js,View::POS_END);
