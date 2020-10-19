$( document ).ready( function( e ) {
  $('[data-toggle="tooltip"]').tooltip();

  var form = $( frame ).contents().find('form');

  if ( buttonCreate ) {
    $( 'body' ).on('click', buttonCreate, function ( e ) {
      e.preventDefault();
      $( buttonSubmit ).css( 'display', 'block' );
      $( buttonSubmit ).css( 'float', 'right' );
      $( frame ).attr( "src", $( this ).attr( 'href' ));
      $( modal ).modal({
        backdrop: 'static',
        keyboard: false,
      });
      $( modal ).modal("show");
    });
  }

  if ( buttonSubmit ) {
    $( 'body' ).on( 'click', buttonSubmit, function( e ){
      e.preventDefault();
      e.stopPropagation();
      let $form = $( frame ).contents().find('form');
      //let $form = window.frames[ 0 ].$( 'form' );
      let formData = new FormData($form[0]);
      
        $.ajax( {
          'url'    : $( $form ).attr( 'action' ),
          'method' : $( $form ).attr( 'method' ),
          'data'   : formData,
          'async'  : false,
          'contentType': false,
          'processData': false,
          'success': function ( data ){
            if ( data.success ) {
              swal(data.title, data.message, data.type);
              window.parent.$.pjax.reload( '#grid', { timeout: 3000 } );

              if ( $( $form ).attr( 'action' ).indexOf( 'create' ) != -1) {
                $( $form ).trigger( 'reset' );
                $selects = window.frames[ 0 ].$( $form ).find( 'select' );

                if ( $selects.length ) {
                  $selects.trigger( 'change' );
                }
              }

              return;
            }

            window.frames[ 0 ].$( $form ).yiiActiveForm( 'updateMessages', data);
            //window.$( frame ).contents( ).find($form).yiiActiveForm( 'updateMessages', data);

          },
          error: function(data) {
              let message;

              if ( data.responseJSON )
              {
                let error = data.responseJSON;
                message =   "Se ha encontrado un error: " +
                  "\n\nCode " + error.code +
                  "\n\nFile: " + error.file +
                  "\n\nLine: " + error.line +
                  "\n\nName: " + error.name +
                  "\n Message: " + error.message;
              }
              else
              {
                  message = data.responseText;
              }

              swal('Oops!!!',message,"error" );
          }
        });
      });
  }


  if (buttonCancel) {
    $( 'body' ).on( 'click', buttonCancel, function(){
      $( frame ).attr( 'src', 'about:blank' );
      $( modal ).modal("hide");

      if ( frameRpt && modalRpt){
        $( frameRpt ).attr( 'src', 'about:blank' );
        $( modalRpt ).modal("hide");
      }

      if ( frameGuide && modalGuide){
        $( frameGuide ).attr( 'src', 'about:blank' );
        $( modalGuide ).modal("hide");
      }

      if ( frameDocumento && modalDocumento){
        $( frameDocumento ).attr( 'src', 'about:blank' );
        $( modalDocumento ).modal("hide");
      }

      $( '#modal-tipoc' ).attr( 'src', 'about:blank' );
      $( '#modal-tipoc' ).modal("hide");

    });
  }

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
                    if( res ) {
                        swal(title, succMessage, "success")
                        window.parent.$.pjax.reload( '#grid', {timeout: 3000} );

                        return;
                    }

                },
                error: function(data) {
                    let message;

                    if ( data.responseJSON )
                    {
                      let error = data.responseJSON;
                      message =   "Se ha encontrado un error: " +
                        "\n\nCode " + error.code +
                        "\n\nFile: " + error.file +
                        "\n\nLine: " + error.line +
                        "\n\nName: " + error.name +
                        "\n Message: " + error.message;
                    }
                    else
                    {
                        message = data.responseText;
                    }

                    swal('Oops!!!',message,"error" );
                }
            });
        }
    });
    return false;
  });

  $( 'body' ).on( 'click', '.pjax-update', function( e ){
    e.preventDefault();
    $( buttonSubmit ).css( 'display', 'block' );
    $( buttonSubmit ).css( 'float', 'right' );
    $( frame ).attr( "src", $( this ).attr( 'href' ));
    $( modal ).modal({
      backdrop: 'static',
      keyboard: false,
      height: '50%',

    });
    $( modal ).modal("show");
  });

  $( 'body' ).on( 'click', '.pjax-view', function( e ){
    e.preventDefault();

    $( buttonSubmit ).css( 'display', 'none' );

    $( frame ).attr( "src", $( this ).attr( 'href' ));
    $( modal ).modal({
      backdrop: 'static',
      keyboard: false
    });
    $( modal ).modal("show");
  });

  $( 'body' ).on( 'click', '.pjax-guide', function( e ){
    e.preventDefault();

    $( buttonSubmit ).css( 'display', 'none' );

    $( frameGuide ).attr( "src", $( this ).attr( 'href' ));
    $( modalGuide ).modal({
      backdrop: 'static',
      keyboard: false
    });
    $( modalGuide ).modal("show");
  });

  $( 'body' ).on( 'click', '.pjax-document', function( e ){
    e.preventDefault();

    $( submitDocumento ).css( 'display', 'block' );

    $( frameDocumento ).attr( "src", $( this ).attr( 'href' ));
    $( modalDocumento ).modal({
      backdrop: 'static',
      keyboard: false
    });
    $( modalDocumento ).modal("show");
  });


  if ( buttonPrint ) {
    $( 'body' ).on( 'click', buttonPrint, function( e ){

      e.preventDefault();

      $( buttonSubmit ).css( 'display', 'none' );

      $( frameRpt ).attr( "src", $( this ).attr( 'href' ));
      $( modalRpt ).modal({
        backdrop: 'static',
        keyboard: false
      });
      $( modalRpt ).modal("show");
    });
  }

  $( 'body' ).on("show.bs.modal",frame, function() {
    let height = $(window).height() - 200;
    $(this).find(".modal-body").css("max-height", height);
  });

  $( 'body' ).on("show.bs.modal",frameRpt, function() {
    let height = $(window).height() - 200;
    $(this).find(".modal-body").css("max-height", height);
  });

  if ( buttonSubmit ) {
      $( 'body' ).on( 'click', buttonSubmit, function( e ){
            e.preventDefault();
            e.stopPropagation();
            let $form = $( frame ).contents().find('form');
            //let $form = window.frames[ 0 ].$( 'form' );

            $.ajax( {
                'url'    : $( $form ).attr( 'action' ),
                'method' : $( $form ).attr( 'method' ),
                'data'   : $( $form ).serialize(),
                'async'  : false,
                'success': function ( data ){
                    if ( data.success )
                    {
                        swal(data.title, data.message, data.type);
                        window.parent.$.pjax.reload(  '#grid', {timeout: 3000} );

                        if ( $( $form ).attr( 'action' ).indexOf( 'create' ) != -1) {
                            $( $form ).trigger( 'reset' );
                            $selects = window.frames[ 0 ].$( $form ).find( 'select' );

                            if ( $selects.length ) {
                                $selects.trigger( 'change' );
                            }
                        }

                        return;
                    }

                    window.frames[ 0 ].$( $form ).yiiActiveForm( 'updateMessages', data);
                    //window.$( frame ).contents( ).find($form).yiiActiveForm( 'updateMessages', data);

                },
                error: function(data) {
                    let message;

                    if ( data.responseJSON )
                    {
                        let error = data.responseJSON;
                        message =   "Se ha encontrado un error: " +
                            "\n\nCode " + error.code +
                            "\n\nFile: " + error.file +
                            "\n\nLine: " + error.line +
                            "\n\nName: " + error.name +
                            "\n Message: " + error.message;
                    }
                    else
                    {
                        message = data.responseText;
                    }

                    swal('Oops!!!',message,"error" );
                }
            });
        });
    }


});

function errorsCode( error ){
  let message ="";
  switch (error) {
    case 1451:
      message = "Verifique que no existan registros dependientes del registro que intenta eliminar";
      break;
  }

  return message;
}
