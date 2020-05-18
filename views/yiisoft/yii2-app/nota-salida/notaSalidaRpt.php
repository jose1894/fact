  <table class="table table-stripped" style="font-size:0.9rem;">
    <thead>
      <tr>
        <td class="left mayus bold"><?= Yii::t('salida','Code')?></td>
        <td class="left mayus bold"><?= Yii::t('producto','Description')?></td>
        <td class="left mayus bold"><?= Yii::t('salida','U.M.')?></td>
        <td class="left mayus bold"><?= Yii::t('salida','Qtty')?></td>
      </tr>
    </thead>
    <tbody style="font-size:0.62rem;">
    <?php
      foreach ($nota->detalles as $key => $value) {
        // code...
        echo "<tr>";
        echo "<td style='width:10%;'>{$value->prodDetalle->cod_prod }</td>";
        echo "<td style='width:50%;word-wrap: break-word;'>{$value->prodDetalle->des_prod }</td>";
        echo "<td style='width:7%;' class='center'>{$value->prodDetalle->umedProd->des_und }</td>";
        echo "<td style='width:6%;' class='center'>{$value->cant_detalle }</td>";
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
