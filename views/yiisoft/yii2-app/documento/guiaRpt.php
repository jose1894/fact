  <table style="font-size:15px; padding: 0 20px 0 0">
    <tbody s>
    <?php
      foreach ($guia->detalles as $key => $value) {
        // code...
        echo "<tr>";
        echo "<td style='width:10%; padding:0 5px;'>{$value->prodDdetalle->cod_prod }</td>";
        echo "<td style='width:5%;  padding:0 10px;' class='left'>". Yii::$app->formatter->asInteger($value->cant_ddetalle) ."</td>";
        echo "<td style='width:50%;word-wrap: break-word; padding:0 20px;'>{$value->prodDdetalle->des_prod }</td>";
        echo "<td style='width:10%;' class='left'>{$value->prodDdetalle->umedProd->des_und }</td>";
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
