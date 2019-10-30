<?php
$total = 0;
$subt = 0;
$subtotal = 0;
$descuento = 0;
$totalImp = 0;
$impuesto = $IMPUESTO/ 100;
?>
  <table class="detalle_documento">
    <thead style="margin: 15px 0;">
      <tr>
        <td class="center mayus bold" style="border:1px solid black;padding:5px 0;"> <?= Yii::t('pedido','Qtty')?></td>
        <td class="center mayus bold" style="border:1px solid black;padding:5px 0;"> <?= Yii::t('pedido','U.M.')?></td>
        <td class="center mayus bold" style="width:12%;border:1px solid black;padding:5px 0;"> <?= Yii::t('pedido','Code')?></td>
        <td class="left mayus bold" style="border:1px solid black;padding: 5px 20px"> <?= Yii::t('pedido','Description')?></td>
        <td class="center bold mayus" style="border:1px solid black;padding:5px 0;"> <?= Yii::t('pedido','N.Price')?></td>
        <td class="center bold mayus" style="border:1px solid black;padding:5px 0;"> <?= Yii::t('pedido','Total')?></td>
      </tr>
    </thead>
    <tbody style="margin-top:10px">
    <?php
      foreach ($documento->detalles as $key => $value) {
        // code...
        echo "<tr style='margin:10px 0;'>";
        echo "<td style='width:5%;  padding:3px 10px;' class='center'> ". Yii::$app->formatter->asInteger($value->cant_pdetalle) ."</td>";
        echo "<td style='width:10%;padding:3px 10px;' class='center'> {$value->productoPdetalle->umedProd->des_und }</td>";
        echo "<td style='padding:0 5px;padding:3px 10px;' class='center'>{$value->productoPdetalle->cod_prod }</td>";
        echo "<td style='width:34%;word-wrap: break-word;padding:3px 10px;'>{$value->productoPdetalle->des_prod }</td>";
        echo "<td style='width:8%;padding:3px 10px;' class='right'> {$value->precio_pdetalle }</td>";
        echo "<td style='width:8%;padding:3px 10px;' class='right'> {$value->total_pdetalle}</td>";
        echo "</tr>";

        $total += $value->total_pdetalle;
        $desc = ( ( $value->plista_pdetalle  *  $value->descu_pdetalle ) / 100 ) * $value->cant_pdetalle / ( ( $value->impuesto_pdetalle / 100 ) + 1)  ;
        $descuento += $desc;
        $subt = ( $value->plista_pdetalle * $value->cant_pdetalle  ) / ( ( $value->impuesto_pdetalle / 100 ) + 1) ;
        $subtotal += $subt;
      }
    ?>
    </tbody>
  </table>
<?php

  $descuento =  $descuento > 0  ? $descuento : 0;
  $precioNeto = $total / ( $impuesto + 1);
  $totalImp = $total - $precioNeto;
  $subtotal2 = $precioNeto;


  echo $footer = '
  <table style="font-size:0.78rem" class="table table-stripped">
    <tr>
      <td style="width:80%" class="right">
      Subtotal
      </td>
      <td style="width:20%" class="right">
      ' . Yii::$app->formatter->asDecimal($subtotal) . '
      </td>
    </tr>
    <tr>
      <td class="right">
      ' . Yii::t('pedido', 'Discount') . '
      </td>
      <td class="right">
      '.Yii::$app->formatter->asDecimal($descuento).'
      </td>
    </tr>
    <tr>
      <td style="width:80%" class="right">
      Subtotal
      </td>
      <td style="width:20%" class="right">
      ' . Yii::$app->formatter->asDecimal($subtotal2) . '
      </td>
    </tr>
    <tr>
      <td class="right">
      ' . Yii::t('pedido','Tax'). ' ' . $IMPUESTO .'%
      </td>
      <td class="right">
      '.Yii::$app->formatter->asDecimal($totalImp).'
      </td>
    </tr>
    <tr>
      <td class="right">
      Total
      </td>
      <td class="right">
      '.Yii::$app->formatter->asDecimal($total).'
      </td>
    </tr>
  </table>
  ';
// $this->registerCssFile("@rptcss/rptCss.css", [
//     'depends' => [\yii\bootstrap\BootstrapAsset::className()],
//     'media' => 'print',
// ], 'css-print-theme');
