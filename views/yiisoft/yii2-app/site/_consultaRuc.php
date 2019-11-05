<?php
use yii\helpers\Html;
use yii\web\View;

$this->title = "Hola";
?>
<h1>Hola</h1>
<?php

$js = <<< JS
let soap = '<?xml version="1.0" encoding="utf-8"?> ';
    soap += '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"> ';
    soap += '<soap:Body>';
    soap += '<GET_CONTRIBUYENTE_DATA xmlns="http://tempuri.org/">';
    soap +=   '<RUC>15603548458</RUC>';
    soap +=   '<TOKEN>OSYS20171010SERVER1</TOKEN>';
    soap += '</GET_CONTRIBUYENTE_DATA>';
    soap += '</soap:Body>';
    soap += '</soap:Envelope>';

  $.ajax({
    url:'http://mifact.net.pe/wsmifactsunat/ConsultaRUC.asmx?op=GET_CONTRIBUYENTE_DATA',
    type: "POST",
    dataType: "xml",
    data: soap,
    contentType: "text/xml; charset=\"utf-8\"",
    success: function( xml ){
      let usuario = [];
      usuario[ 'ruc' ] = $( xml ).find("aNumero_RUC")[0].textContent;
      usuario[ 'razonSocial' ] = $( xml ).find("aRazon_Social")[0].textContent;
      usuario[ 'status' ] = $( xml ).find("aEstado_Contr")[0].textContent;
      usuario[ 'condicion' ] = $( xml ).find("aCondicion_Contr")[0].textContent;
      usuario[ 'telefono' ] = $( xml ).find("aTelefono_Contr")[0].textContent;
      usuario[ 'direccion' ] = $( xml ).find("aDireccion_Fiscal")[0].textContent;
      usuario[ 'nombreComerc' ] = $( xml ).find("aNombre_Comercial")[0].textContent;
      usuario[ 'msgAPP' ] = $( xml ).find("aMensajeAPP")[0].textContent;
      usuario[ 'codMsgAPP' ] = $( xml ).find("aCod_MensajeAPP")[0].textContent;
      usuario[ 'ubigeo' ] = $( xml ).find("aUbigeo")[0].textContent;

      console.log(usuario);

    }
  });
JS;

$this->registerJs($js,View::POS_LOAD);
