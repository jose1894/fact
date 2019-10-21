<?php
use yii\web\View;
use yii\helpers\Url;
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
        <button  id="submitGuia" type="button" class="btn btn-flat btn-success pull-right " ><span class="fa fa-circle-play"></span> <?= Yii::t('documento','Generate guide')?></button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
$js = '

  $( "body" ).on("click", ".close-btn", function ( e ) {
    e.preventDefault();
    $( "#frame-guide" ).attr( "src", "about:blank" );
    $( "#modal-guide" ).modal("hide");
  });


  $( "body" ).on( "click", submitGuide, function( e ){
    e.preventDefault();
    e.stopPropagation();

    let $form = $( frameGuide ).contents().find("form");
    //let $form = window.frames[ 0 ].$( "form" );

      $.ajax( {
        "url"    : $( $form ).attr( "action" ),
        "method" : $( $form ).attr( "method" ),
        "data"   : $( $form ).serialize(),
        "async"  : false,
        "success": function ( data ) {
          if ( data.success ) {
            window.parent.$.pjax.reload( { container: "#grid" } );

            if ( $( $form ).attr( "action" ).indexOf( "create" ) != -1) {
              $( $form ).trigger( "reset" );
              $selects = window.frames[ 0 ].$( "form" ).find( "select" );

              if ( $selects.length ) {
                $selects.trigger( "change" );
              }
            }

            swal({
              title: "'.Yii::t("documento","Do you want to issue the document?").'",
              icon: "info",
              buttons: true,
              dangerMode: true,
            })
            .then((willIssue) => {
              if (willIssue) {
                window.open("'.Url::to(['documento/guia-rpt']).'?id=" + data.id,"_blank");
              }

              swal(data.title, data.message, data.type);
              $( ".close-btn" ).trigger( "click" );

            });

            return;
          }

          window.frames[ 0 ].$( $form ).yiiActiveForm( "updateMessages", data);
        },
        "error": function(data) {
            let message;

            if ( data.responseJSON ) {
              let error = data.responseJSON;
              message =   "Se ha encontrado un error: " +
                "\n\nCode " + error.code +
                "\n\nFile: " + error.file +
                "\n\nLine: " + error.line +
                "\n\nName: " + error.name +
                "\n Message: " + error.message;
            } else {
                message = data.responseText;
            }

            swal("Oops!!!",message,"error" );
        }
      });

  });

';

$this->registerJs($js,View::POS_END);
