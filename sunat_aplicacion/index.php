<?php
//Create the client object

        $context = stream_context_create(array(
             'https' => array('verify_peer' => false, 'verify_peer_name'=>false, 'allow_self_signed' => true)
       ));


        try {
              $fileName = "20604954241-01-FE01-00000001.zip";
              $file = file_get_contents($fileName);
              $fileBinaryData = "".base64_encode($file)."";

              $argumentos = [ 'fileName' => $fileName, 'contentFile' => $fileBinaryData];

               $WSHeader = '<wsse:Security>
                            <wsse:UsernameToken>
                            <wsse:Username>20100066603MODDATOS</wsse:Username>
                            <wsse:Password>moddatos</wsse:Password>
                            </wsse:UsernameToken>
                            </wsse:Security>
                            ';
              $headers = new SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd', 'Security', new SoapVar($WSHeader, XSD_ANYXML));

              echo print_r($headers);exit();
              $configClient = new soapclient('https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService?wsdl',[]);
              $response = $configClient->__soapCall('sendBill', $argumentos, null, $headers);

              echo "Response:\n" . $configClient->__getLastResponse() . "\n";



               //$configResponse = $configClient->enableALLProductFeatures();
       } catch (SoapFault $exception) {
               echo "Problem..... : ";
               echo $exception;
       }



//Use the functions of the client, the params of the function are in
//the associative array
// $params = array('CountryName' => 'Spain', 'CityName' => 'Alicante');
 // $response = $soapclient->GetWeatherInformation();

// print_r($response);
