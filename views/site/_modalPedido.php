<?php
use yii\web\View;
?>
<div class="modal modal-wide fade" id="modal" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-btn" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <iframe src="" id="framePedido" width="100%" height="600" frameBorder="0"></iframe>
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
<?php /*
$this->registerJsFile(
    '@web/js/app.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]); */
