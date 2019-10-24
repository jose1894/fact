$( document ).ready( function ( e ){
    /*
    const validateDetail = function (){
      let retorno = true;
          if( !$('#pedido-fecha_pedido').val() )
          {
              swal('Pedido', 'Debe completar este campo', 'warning');
              $('#pedido-fecha_pedido').setfocus();
              retorno = false;
          }

          if( !$('#pedido-clte_pedido').val())
          {
              swal('Pedido', 'Debe completar este campo', 'warning');
              $('#pedido-clte_pedido').setfocus();
              retorno = false;
          }

          if( !$('#pedido-vend_pedido').val())
          {
              swal('Pedido', 'Debe completar este campo', 'warning');
              $('#pedido-vend_pedido').setfocus()
              retorno = false;
          }

          if( !$('#pedido-moneda_pedido').val())
          {
              swal('Pedido', 'Debe completar este campo', 'warning');
              $('#pedido-moneda_pedido').setfocus()
              retorno = false;
          }

          if( !$('#pedido-almacen_pedido').val())
          {
              swal('Pedido', 'Debe completar este campo', 'warning');
              $('#pedido-almacen_pedido').setfocus()
              retorno = false;
          }

          if( !$('#pedido-condp_pedido').val())
          {
              swal('Pedido', 'Debe completar este campo', 'warning');
              $('#pedido-condp_pedido').setfocus()
              retorno = false;
          }

    }*/

  $( 'body' ).on( 'click', buttonSubmit_detail, function(){
    var $form = $( frame_detail ).contents().find('form');

      $.ajax( {
        'url'    : $( $form ).attr( 'action' ),
        'method' : $( $form ).attr( 'method' ),
        'data'   : $( $form ).serialize(),
        'async'  : false,
        'success': function ( data ){
          if ( data.success )
          {
              $( buttonCancel_detail ).trigger( 'click' );
              window.frames[0].$.pjax.reload( { container: '#grid' } );
              return;
          }

          window.frames[1].$( $form ).yiiActiveForm( 'updateMessages', data);
        },
        error: function(data) {
            let message;

            if ( data.responseJSON )
            {
              let error = data.responseJSON.errorInfo;
              message =   "Se ha encontrado un error: " +
                "\n\n\n " + errorsCode(error[1]) +
                "\n\nException: " + error[0] +
                "\n\nCode: " + error[1] +
                "\n Message: " + error[2];
            }
            else
            {
                message = data.responseText;
            }

            swal('Oops!!!',message,"error" );
        }
    });
  });

  $( 'body' ).on( 'click', buttonCancel_detail, function(){
    $( frame_detail ).attr( 'src', 'about:blank' );
    $( modal_detail ).modal("hide");
  });
});
