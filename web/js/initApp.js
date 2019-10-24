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

$( 'body' ).on( 'keypress', '.number-decimals', function ( e ){
  return isDecimal( e, this );
});

$( 'body' ).on( 'blur', '.number-decimals', function ( e ){
  let valor = parseFloat( $( this ).val() );
  $( this ).val( round(valor) );
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

function checkDuplicate( _currSelect, row, selects ) {
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

function round( num ){
  return Math.round(num * 100) / 100;
}
/*
formatMoney(number, a): string {
        const separador = JSON.parse(localStorage.getItem('languageInt'));
        const tn = separador.default[13][1];
        const dn = separador.default[13][0];
        const n = number;
        if (number !== undefined && number !== null) {
            if (dn === ',') { number = (number.toString()).replace(',', '.'); }
            const val = (number.toString()).split('.');
            const valInt = isNaN(val[0]) ? '0' : val[0];
            const c = isNaN(a = Math.abs(a)) ? 2 : a;
            const d = this.decimalSeparator(dn);
            const t = this.milesSeparator(tn);
            const s = n < 0 ? '-' : '';
            let i = valInt === '' ? '0' : valInt;
            i = i.replace('-', '');
            let numDecimal = '';
            if (val[1] === '' || val.length === 1) {
                for (let k = 0; k < a; k++) { numDecimal += '0'; }
            } else {
                // tslint:disable-next-line:radix
                const decN = val[1];  // c - ((number.toString()).slice((c * -1)).replace('.' , '')).length;
                numDecimal = decN.substr(0, a); // (number.toString()).slice((c * -1)).replace('.' , '');
                for (let k = 0; k < (c - decN.length); k++) { numDecimal += '0'; }
            }
            // if ( valInt === '999999999999999' ) {i = val[0]; }
            const long = i.length; // longintud
            const j = (long) > 3 ? long % 3 : 0;
            const numero = s + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + t) + (c ? d + numDecimal : '');
            return numero;
        }
    }

    decimalSeparator(dec_point): any {
        if (dec_point === '.') {
            // tslint:disable-next-line:no-unused-expression
            (dec_point === undefined) ? '.' : dec_point;
        } else {
            // tslint:disable-next-line:no-unused-expression
            dec_point === undefined ? ',' : dec_point;
        }
        return dec_point;
    }

    milesSeparator(mil_point): any {
        if (mil_point === ',') {
            // tslint:disable-next-line:no-unused-expression
            mil_point === undefined ? ',' : mil_point;
        } else {
            // tslint:disable-next-line:no-unused-expression
            mil_point === undefined ? '.' : mil_point;
        }
        return mil_point;
    }
*/
