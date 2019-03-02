$( formName ).on( 'beforeSubmit', function( e ){
  e.preventDefault();

  $.ajax( {
    'url'    : $( this ).attr( 'action' ),
    'method' : $( this ).attr( 'method' ),
    'data'   : $( this ).serialize(),
    'success': function ( data ){
      if ( data.success ){
        window.parent.$.pjax.reload( { container: '#grid' } );
      }
    }
  } )
});
