<table style="font-size:12px; padding: 0 20px 0 0">
    <tbody>
    <?php
    foreach ($guia->detalles as $key => $value) {
        // code...
        echo "<tr>";
        echo "<td style='width:20%; padding:0 5px;'>".trim($value->prodDdetalle->cod_prod)."</td>";
        echo "<td style='  padding:0 5px;' class='left'>". Yii::$app->formatter->asInteger($value->cant_ddetalle) ."</td>";
        echo "<td style='word-wrap: break-word; padding:0 20px;'>{$value->prodDdetalle->des_prod }</td>";
        echo "<td style='' class='left'>{$value->prodDdetalle->umedProd->des_und }</td>";
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
