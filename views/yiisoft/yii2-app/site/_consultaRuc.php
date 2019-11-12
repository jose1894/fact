<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
    soap +=   '<RUC>20600838386</RUC>';
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

$this->registerJs('
  let baseUrl = ' . Url::base() . ';
',View::POS_HEAD);

$js2 = <<< JS

function enviarSunat(){
  let path = baseUrl;
  let soap = ' ' ;
      soap += '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe" xmlns:wsse="http://docs.oasisopen.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
      soap += ' <soapenv:Header>';
      soap += '   <wsse:Security>';
      soap += '   <wsse:UsernameToken>';
      soap += '     <wsse:Username>20604954241MODDATOS</wsse:Username>';
      soap += '     <wsse:Password>moddatos</wsse:Password>';
      soap += '   </wsse:UsernameToken>';
      soap += '   </wsse:Security>';
      soap += ' </soapenv:Header>';
      soap += ' <soapenv:Body>';
      soap += '   <ser:sendBill>';
      soap += '     <fileName>20100066603-01-F001-1.zip</fileName>';
      soap += '     <contentFile>cid:20100066603-01-F001-1.zip</contentFile>';
      soap += '   </ser:sendBill>';
      soap += ' </soapenv:Body>';
      soap += '</soapenv:Envelope>';

  $.ajax({
    url:'https://e-factura.sunat.gob.pe/ol-ti-itcpfegem/billService?wsdl',
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
}

enviarSunat();
JS;

$this->registerJs($js.' '.$js2,View::POS_LOAD);
