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
        <button type="button" class="close close-btn" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body iframe-container">
        <iframe src="" id="frame-tipoc" width="100%" height="600" frameBorder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-flat btn-danger pull-left close-btn"><span class="fa fa-remove"></span> <?= Yii::t('app','Close')?></button>
        <button id="submit-tipoc" type="button" class="btn btn-flat btn-success"><span class="fa fa-save"></span> <?= Yii::t('app','Save') ?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal tipo cambio -->
<?php
$this->registerJsVar('consultaTipoC',Url::to(['tipo-cambio/consulta-tipo']));
$this->registerJsVar('fecha', date('Y-m-d'));
$this->registerJsVar('frameTipoC',Url::to(['tipo-cambio/diario']));
//$this->registerJsVar('fechaTipoC',date('Y-m-d'));

$this->registerCss("
.iframe-container {
  overflow: hidden;
  padding-top: 56.25%; /* 16:9*/
  position: relative;
}

.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
}
");
$js = <<<JS
  // Consulta si el tipo de cambio ha sido seteado al dia

  $.ajax({
    method	: 'GET',
    url		: consultaTipoC,
    data : { fecha: fecha },
    success : function( data ){
      data = JSON.parse(data);
      if ( !data.success ) {
        $( '#modal-tipoc' ).modal( {backdrop: 'static', keyboard: false} );
        $( '#modal-tipoc' ).modal( 'show' );
        $( '#frame-tipoc' ).prop( 'src', frameTipoC);
      }
    },
	error 	: function( data ) {
		console.log( data );
	}
  });
  // Cerrar modal tipo de cambio
  $( '.close-btn' ).click( function(){
    $( '#modal-tipoc' ).modal( 'hide' );
  });

  $( '#submit-tipoc' ).click(function( e ){
      e.preventDefault();
      e.stopPropagation();

      let _form = $( '#frame-tipoc' ).contents().find('form');

      $.ajax( {
        'url'    : $( _form ).attr( 'action' ),
        'method' : $( _form ).attr( 'method' ),
        'data'   : $( _form ).serialize(),
        'async'  : false,
        'success': function ( data ) {
          if ( data.success ) {
            swal(data.title, data.message, data.type);

            if ( $( _form ).attr( 'action' ).indexOf( 'create' ) != -1) {
              $( _form ).trigger( 'reset' );
            }

            $( '#modal-tipoc' ).modal( 'hide' );

            return;
          }
          //window.$( "#frame-tipoc" ).contents( ).find(_form).yiiActiveForm( 'updateMessages', data);
          window.frames[ 2 ].$( _form ).yiiActiveForm( 'updateMessages', data);
        },
        'error': (data) => {
            let message;

            if ( data.responseJSON ) {
              let error = data.responseJSON;
              message =   "Se ha encontrado un error: " +
              "\\n\\n Code " + error.code +
              "\\n\\nFile: " + error.file +
              "\\n\\nLine: " + error.line +
              "\\n\\nName: " + error.name +
              "\\nMessage: " + error.message;
            } else {
                message = data.responseText;
            }

            swal('Oops!!!',message,"error" );
        }
      });
  });
JS;

$this->registerJs($js, View::POS_LOAD);

$this->registerJsFile(
    '@web/js/app.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
