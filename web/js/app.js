$( document ).ready( function( e ){
  var form = $( frame ).contents().find('form');

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
    var $form = $( frame ).contents().find('form');

      $.ajax( {
        'url'    : $( $form ).attr( 'action' ),
        'method' : $( $form ).attr( 'method' ),
        'data'   : $( $form ).serialize(),
        'async'  : false,
        'success': function ( data ){
          if ( data.success )
          {
            swal(data.title, data.message, data.type);
            window.parent.$.pjax.reload( { container: '#grid' } );
            $( $form ).trigger( 'reset' );
            return;
          }
          else if ( data.success === false )
          {
            swal(data.title, data.message, data.type);
            return ;
          }
          window.frames[0].$( $form ).yiiActiveForm( 'updateMessages', data);
        }
      });
  });

  $( 'body' ).on( 'click', buttonCancel, function(){
    $( frame ).attr( 'src', '#' );
    $( modal ).modal("hide");

  });

  $( 'body' ).on( 'click', '.pjax-delete', function( e ){

    e.preventDefault();

    var id = $( this ).data( 'id' );
    var title = $( this ).data( 'title' );
    var icon =  $( this ).data( 'icon' );
    var ok =  $( this ).data( 'ok' );
    var url =  $( this ).attr( 'href' );
    var message = $( this ).data( 'message' );
    var succMessage = $( this ).data( 'succmessage' );

    data  = {
            title: title,
            text: message,
            icon: icon,
            confirmButtonClass: "btn-danger",
            confirmButtonText: ok ,
            showCancelButton: true,
            buttons: true,
            dangerMode: true,
        };

    // Show the user a swal confirmation window
    swal( data ).
        then( (willdelete) => {
        if (willdelete) {
            // This function will run ONLY if the user clicked "ok"
            // Only here we want to send the request to the server!
            $.ajax({
                type: "POST",
                url: url ,
                data: {id:id},
                success: function (data) {
                    var res = $.parseJSON(data);
                    if(res != false) {
                        swal(title, succMessage, "success")
                        window.parent.$.pjax.reload( { container: '#grid' } )
                    }
                }
            });
        }
        /*function() {
            // This function will run if the user clicked "cancel"
            window.location.href = "<?php echo Yii::$app->request->baseUrl;?>/todo/index/";
        }*/
    });
    return false;
  });

  $( 'body' ).on( 'click', '.pjax-update', function( e ){
    e.preventDefault();

    $( frame ).attr( "src", $( this ).attr( 'href' ));
    $( modal ).modal({
      backdrop: 'static',
      keyboard: false
    });
    $( modal ).modal("show");
  });

  $( 'body' ).on( 'click', '.pjax-view', function( e ){
    e.preventDefault();

    $( frame ).attr( "src", $( this ).attr( 'href' ));
    $( modal ).modal({
      backdrop: 'static',
      keyboard: false
    });
    $( modal ).modal("show");
  });
});
