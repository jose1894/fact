<h1>Pedido</h1>
<?php
foreach ($pedido->detalles as $key => $value) {
  // code...
  $producto = $value->productoPdetalle;
  echo $producto->cod_prod." ".$producto->des_prod."<br>";
}
