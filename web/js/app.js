$( document ).ready( function( e ){

  var form = $( frame ).contents().find('form');

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

  $( 'body' ).on( 'click', buttonSubmit, function( e ){
    e.preventDefault();
    e.stopPropagation();
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

            if ( $( $form ).attr('action').indexOf('create') != -1)
            {
              $( $form ).trigger( 'reset' );
            }

            $selects = window.frames[0].$($form).find('select');

            if ( $selects.length )
              $selects.trigger( 'change' );

            return;
          }

          window.frames[0].$( $form ).yiiActiveForm( 'updateMessages', data);
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


  $( 'body' ).on( 'click', buttonCancel, function(){
    $( frame ).attr( 'src', 'about:blank' );
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
                    if(res !== false) {
                        swal(title, succMessage, "success")
                        window.parent.$.pjax.reload( { container: '#grid' } )
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

  $( 'body' ).on("show.bs.modal","#frame", function() {
    let height = $(window).height() - 200;
    $(this).find(".modal-body").css("max-height", height);
  });

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
