  <table class="table table-stripped" style="font-size:0.65rem;">
    <thead>
      <tr>
        <td class="left mayus bold">#</td>
        <td class="left mayus bold"><?= Yii::t('pedido','Code')?></td>
        <td class="left mayus bold"><?= Yii::t('pedido','Description')?></td>
        <td class="left mayus bold"><?= Yii::t('pedido','U.M.')?></td>
        <td class="left mayus bold"><?= Yii::t('pedido','Qtty')?></td>
        <td class="left mayus bold"><?= Yii::t('pedido','G.Price')?></td>
        <td class="left mayus bold">% <?= Yii::t('pedido','Disc')?></td>
        <td class="right bold mayus"><?= Yii::t('pedido','N.Price')?></td>
        <td class="right bold mayus"><?= Yii::t('pedido','Total')?></td>
      </tr>
    </thead>
    <tbody style="font-size:0.62rem;">
    <?php
      foreach ($pedido->detalles as $key => $value) {
        // code...
        echo "<tr>";
        echo "<td style='width:5%;'>" . ($key + 1) . "</td>";
        echo "<td style='width:12%;'>{$value->productoPdetalle->cod_prod }</td>";
        echo "<td style='width:46%;word-wrap: break-word;'>{$value->productoPdetalle->des_prod }</td>";
        echo "<td style='width:7%;' class='right'>{$value->productoPdetalle->umedProd->des_und }</td>";
        echo "<td style='width:6%;' class='right'>{$value->cant_pdetalle }</td>";
        echo "<td style='width:6%; text-align:right'>{$value->plista_pdetalle }</td>";
        echo "<td style='width:8%; text-align:right'>{$value->descu_pdetalle }</td>";
        echo "<td style='width:8%;' class='right'>{$value->precio_pdetalle }</td>";
        echo "<td style='width:8%;' class='right'>{$value->total_pdetalle}</td>";
        echo "</tr>";
      }
    ?>
    </tbody>
  </table>
<?php
$this->registerCssFile("@rptcss/rptCss.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    'media' => 'print',
], 'css-print-theme');
