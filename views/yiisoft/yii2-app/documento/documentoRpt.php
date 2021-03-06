<?php
use yii\web\View ;

use app\models\TipoIdentificacion;

$total = 0;
$subt = 0;
$subtotal = 0;
$descuento = 0;
$totalImp = 0;
$impuesto = $IMPUESTO/ 100;
?>
  <table class="detalle_documento" style="border: 1px solid black;">
    <thead style="margin: 15px 0;">
      <tr>
        <td width="5%" class="center mayus bold" style="border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;padding:5px 0;"> <?= Yii::t('pedido','Qtty')?></td>
        <td width="9%" class="center mayus bold" style="padding:5px 0;border-top: 1px solid black;border-bottom: 1px solid black;"> <?= Yii::t('pedido','U.M.')?></td>
        <td width="15%" class="center mayus bold" style="padding:5px 0;border-top: 1px solid black;border-bottom: 1px solid black;"> <?= Yii::t('pedido','Code')?></td>
        <td class="left mayus bold" style="padding: 5px 20px;border-top: 1px solid black;border-bottom: 1px solid black;"> <?= Yii::t('pedido','Description')?></td>
        <td class="center bold mayus" style="padding:5px 0;border-top: 1px solid black;border-bottom: 1px solid black;"> <?= Yii::t('pedido','U.Price')?></td>
        <td class="center bold mayus" style="padding:5px 0;border-right:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"> <?= Yii::t('pedido','Total')?></td>
      </tr>
    </thead>
    <tbody style="margin-top:10px">
    <?php
      foreach ($documento->pedidoDoc->detalles as $key => $value) {
        // code...
        echo "<tr style='margin:10px 0;'>";
        echo "<td style='padding:3px 10px;' class='center'> ". Yii::$app->formatter->asInteger($value->cant_pdetalle) ."</td>";
        echo "<td style='padding:3px 10px;' class='center'> {$value->productoPdetalle->umedProd->des_und }</td>";
        echo "<td style='padding:0 5px;padding:3px 10px;' class='center'>{$value->productoPdetalle->cod_prod }</td>";
        echo "<td style='word-wrap: break-word;padding:3px 10px;'>{$value->productoPdetalle->des_prod }</td>";
        echo "<td style='padding:3px 10px;' class='right'> {$value->precio_pdetalle }</td>";
        echo "<td style='padding:3px 10px;' class='right'> {$value->total_pdetalle}</td>";
        echo "</tr>";

        $total += $value->total_pdetalle;
        $desc = ( ( $value->plista_pdetalle  *  $value->descu_pdetalle ) / 100 ) * $value->cant_pdetalle / ( ( $value->impuesto_pdetalle / 100 ) + 1)  ;
        $descuento += $desc;
        $subt = ( $value->plista_pdetalle * $value->cant_pdetalle  ) / ( ( $value->impuesto_pdetalle / 100 ) + 1) ;
        $subtotal += $subt;
      }
      $descuento =  $descuento > 0  ? $descuento : 0;
      $precioNeto = $total / ( $impuesto + 1);
      $totalImp = $total - $precioNeto;
      $subtotal2 = $precioNeto;
    ?>
    </tbody>
  </table>
  <br>
  <div class="" style="width:100%">

      <div class="gradient" style="float: right; width: 100%; margin-bottom: 0pt; ">
        <b>SON : <?= NumerosEnLetras::convertir( $total ,$documento->pedidoDoc->monedaPedido->des_moneda, false, 'centimos') ?></b>
      </div>
      <div class="gradient" style="float: left; width: 15%; margin-top: 5pt;margin-bottom: 1pt">
        <?php

          // $tipoDoc = ($documento->tipo_doc == 3) ? 1 : 3;
          //
          // if ( $documento->pedidoDoc->cltePedido->tipoIdentificacion->cod_tipoi == TipoIdentificacion::TIPO_RUC ){
          //   $tipoDocClte = TipoIdentificacion::TIPO_RUC;
          //   $docClte = $documento->pedidoDoc->cltePedido->ruc_clte;
          // } else {
          //   $tipoDocClte = TipoIdentificacion::TIPO_DNI;
          //   $docClte = $documento->pedidoDoc->cltePedido->dni_clte;
          // }
          //
          // $code = $rucEmpresa ."|". $tipoDoc ."|". $documento->tipoDoc->abrv_tipod . $documento->numeracion->serie_num . "|" . substr($documento->cod_doc,-8) . "|" . $documento->totalimp_doc . "|22684.32|";
          // $code .= $documento->fecha_doc . "|" . $tipoDocClte . "|" . $docClte ."|";
          //
          // $valorResumen = base64_encode(hash("sha256",$code,false));
          // $code .= $code . $valorResumen;
          $code = $documento->valorr_doc;

        ?>

        <barcode code="<?= $code ?>" type="QR" class="barcode" size="1" error="M" disableborder="1" style="width:100%" />
          &nbsp;
        <span style="float:left;font-size:8px;margin-top:25px;width:15%">Representaci&oacute;n impresa del documento electr&oacute;nico</span>
      </div>
      <div class="gradient" style="float: right; width: 83%; margin-bottom: 0pt; ">
        <div class="" style="border:1px solid black; width:40%;float:right;border-radius: 3mm / 3mm;padding: 1em;">
          <table  class="sumatoria_documento" align="right">
            <tr>
              <td width="60%" class="right">
              Op. GRAVADA
              </td>
              <td class="right">
              <?= Yii::$app->formatter->asDecimal($subtotal2) ?>
              </td>
            </tr>
            <tr>
              <td class="right">
                Op. INAFECTA
              </td>
              <td class="right">
                0.00
              </td>
            </tr>
            <tr>
              <td class="right">
              <?= Yii::t('pedido','Tax'). ' ' . $IMPUESTO .'%' ?>
              </td>
              <td class="right">
              <?= Yii::$app->formatter->asDecimal($totalImp) ?>
              </td>
            </tr>
            <tr>
              <td class="right">
              TOTAL
              </td>
              <td class="right">
              <?= Yii::$app->formatter->asDecimal($total) ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
  </div>
  
