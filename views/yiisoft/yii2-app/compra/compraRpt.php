<table class="table table-stripped" style="font-size:0.75rem;">
    <thead>
      <tr>
        <td class="left mayus bold"><?= Yii::t('compra','Code')?></td>
        <td class="left mayus bold"><?= Yii::t('compra','Description')?></td>
        <td class="left mayus bold"><?= Yii::t('compra','U.M.')?></td>
        <td class="left mayus bold"><?= Yii::t('compra','Qtty')?></td>
        <td class="left mayus bold"><?= Yii::t('compra','G.Price')?></td>
        <td class="left mayus bold"><?= Yii::t('compra','Disc')?></td>
        <td class="right bold mayus"><?= Yii::t('compra','N.Price')?></td>
        <td class="right bold mayus"><?= Yii::t('compra','Total')?></td>
      </tr>
    </thead>
    <tbody style="font-size:0.62rem;">
    <?php
      foreach ($compra->detalles as $key => $value) {
        // code...
        echo "<tr>";
        echo "<td style='width:10%;'>{$value->prodCdetalle->cod_prod }</td>";
        echo "<td style='width:50%;word-wrap: break-word;'>{$value->prodCdetalle->des_prod }</td>";
        echo "<td style='width:7%;' class='right'>{$value->prodCdetalle->umedProd->des_und }</td>";
        echo "<td style='width:6%;' class='right'>{$value->cant_cdetalle }</td>";
        echo "<td style='width:6%; text-align:right'>{$value->plista_cdetalle }</td>";
        echo "<td style='width:6%; text-align:right'>{$value->descu_cdetalle }</td>";
        echo "<td style='width:8%;' class='right'>{$value->precio_cdetalle }</td>";
        echo "<td style='width:8%;' class='right'>{$value->total_cdetalle}</td>";
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
