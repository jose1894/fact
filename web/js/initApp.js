//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
});
//Red color scheme for iCheck
$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
  checkboxClass: 'icheckbox_minimal-red',
  radioClass   : 'iradio_minimal-red'
})
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
});

//FUNCIONES

$( 'body' ).on( 'keypress', '.number-integer', function ( e ){
  return isInteger( e, this );
});

$( 'body' ).on( 'keypress', '.number-decimals,.number-decimals3', function ( e ){
  return isDecimal( e, this );
});

$( 'body' ).on( 'blur', '.number-decimals', function ( e ){
  let valor = parseFloat( $( this ).val() );
  valor = ( valor ) ? valor : 0;
  $( this ).val( round(valor) );
});

$( 'body' ).on( 'blur', '.number-decimals3', function ( e ){
    let valor = parseFloat( $( this ).val() );
    valor = ( valor ) ? valor : 0;
    $( this ).val( decimals3(valor) );
});

// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isDecimal(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode

    if (
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57))
        return false;

    return true;
}

  // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A INTEGER VALUE.
function isInteger(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode;

    if ( evt.which != 8 && evt.which != 0 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function checkDuplicate( _currSelect, row, selects )
{
  let band = false;
  row = row[ 1 ];

  for( let i = 0; i < selects.length; i++) {
      if ( _currSelect.attr("id") === $( selects[i] ).attr("id") ) {
        continue;
      }

      if (  _currSelect.val() === $( selects[i] ).val()  ) {
        band = true;
        break;
      }
  }

  return band;
}

function getRow( row = null ) {
  if ( row ) {
    return function( ) {
      return row;
    }
  }
}
// Redondea a 2 digitos decimales
function round( num )
{
  return parseFloat(Math.round(num * 100) / 100).toFixed(2);
}

/*
*  Establece 3 digitos decimales
*/
function decimals3( num )
{
    return parseFloat( num ).toFixed(3);
}