<?php
use yii\helpers\Html;
?>
<table class="table">
  <thead>
    <td><?= Yii::t('pedido','Code')?></td>
    <td><?= Yii::t('pedido','Description')?></td>
    <td><?= Yii::t('pedido','Quantity')?></td>
    <td><?= Yii::t('pedido','List price')?></td>
    <td><?= Yii::t('pedido','Discount')?></td>
    <td><?= Yii::t('pedido','Price')?></td>
    <td><?= Yii::t('pedido','Total')?></td>
  </thead>
  <tbody>

  <?php
    foreach ($pedido->detalles as $key => $value) {
      // code...
      $precioT = $value->precio_pdetalle - ( $value->precio_pdetalle * ( $value->descu_pdetalle / 100 ) );
      $precioT = Yii::$app->formatter->format($precioT, ['decimal', 2]);
      $total = $precioT * $value->cant_pdetalle;
      $total = Yii::$app->formatter->format($total, ['decimal', 2]);
      echo "<tr>";
      echo "<td>{$value->productoPdetalle->cod_prod }</td>";
      echo "<td style='width:300px;word-wrap: break-word'>{$value->productoPdetalle->des_prod }</td>";
      echo "<td>{$value->cant_pdetalle }</td>";
      echo "<td>{$value->precio_pdetalle }</td>";
      echo "<td>{$value->descu_pdetalle }</td>";
      echo "<td>{$precioT }</td>";
      echo "<td>{$total}</td>";
      echo "</tr>";
    }
  ?>
  </tbody>
</table>
