<?php
use kartik\mpdf\Pdf;
$pdf = Yii::$app->pdf; // or new Pdf();
$pdf->cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
$mpdf = $pdf->api; // fetches mpdf api

$mpdf->SetHTMLHeader('
<div class="row">
  <div class="col-lg-4">
    <img src="img/MARVIG.JPG" height="124" width="154">
  </div>
  <div class="col-lg-4">

  </div>
  <div class="col-lg-4">

  </div>
</div>');
foreach ($pedido->detalles as $key => $value) {
  // code...
  $producto = $value->productoPdetalle;
  echo $producto->cod_prod." ".$producto->des_prod."<br>";
}

echo $mpdf->Output('filename.pdf', 'I'); // call the mpdf api output as needed
