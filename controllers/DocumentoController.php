<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Documento;
use app\models\NotaSalida;
use app\models\NotaSalidaDetalle;
use app\models\DocumentoDetalle;
use app\models\Pedido;
use app\models\Producto;
use app\models\TipoCambio;
use app\models\Numeracion;
use app\models\TipoIdentificacion;
use app\models\DocumentoSearch;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use NumerosEnLetras;
use DateTime;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\See;


/**
 * DocumentoController implements the CRUD actions for Documento model.
 */
class DocumentoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Documento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Finds the Documento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
    }

    public function actionPedidosPendientes()
    {
      //$this->layout = "justStuff";
      $searchModel = new PedidoSearch();

      $dataProvider = $searchModel->searchPendientes(Yii::$app->request->queryParams);

      return $this->render('listado-generar', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
    }

    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionFacturaCreate( $id )
    {
        $model = new Documento();
        $model->scenario = Documento::SCENARIO_FACTURA;
        $modelPedido = Pedido::findOne( $id );

        $IMPUESTO = SiteController::getImpuesto();

        if ( $modelPedido === null) {
            throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
        }

        $post = Yii::$app->request->post();


        if ($model->load($post)) {
          $modelNotaSalida = new NotaSalida();
          $modelNotaSalidaDetalle = [new NotaSalidaDetalle()];



          $notaSalidaDetalle = [];
          foreach ($post['PedidoDetalle'] as $key => $value) {
            $notaSalidaDetalle[$key] = ['prod_detalle' => $value['prod_pdetalle'],'cant_detalle' => $value['cant_pdetalle']];
          }

          $tipoDoc = ($model->tipo_doc == 3) ? 1 : 3;

          if ( $model->pedidoDoc->cltePedido->tipoIdentificacion->cod_tipoi == TipoIdentificacion::TIPO_RUC ){
            $tipoDocClte = TipoIdentificacion::TIPO_RUC;
            $docClte = $model->pedidoDoc->cltePedido->ruc_clte;
          } else {
            $tipoDocClte = TipoIdentificacion::TIPO_DNI;
            $docClte = $model->pedidoDoc->cltePedido->dni_clte;
          }

          $sucursal = SiteController::getSucursal();
          $modelNotaSalida->sucursal_trans = $sucursal;
          $model->sucursal_doc = $sucursal;
          $model->status_doc = 1;
          $modelNotaSalida->usuario_trans = Yii::$app->user->id;
          $modelNotaSalida->ope_trans = $modelNotaSalida::OPE_TRANS;
          $num = Numeracion::getNumeracion( $modelNotaSalida::NOTA_SALIDA );
          $codigo = intval( $num['numero_num'] ) + 1;
          $codigo = str_pad($codigo,10,'0',STR_PAD_LEFT);
          $modelNotaSalida->codigo_trans = $codigo;
          $modelNotaSalida->tipo_trans = $model::TIPO_FACTURA;
          $modelNotaSalida->almacen_trans = $modelPedido->almacen_pedido;
          $fecha = explode("/",$model->fecha_doc);
          $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
          $model->fecha_doc = $fecha;
          $modelNotaSalida->fecha_trans =  $fecha;
          $modelPedido->estatus_pedido = $modelPedido::DOCUMENTO_GENERADO;
          $model->almacen_doc = $modelPedido->almacen_pedido;

          $model->totalimp_doc = $post['impuesto'];
          $model->total_doc = $post['total'];


          // validate all models
          $valid = $model->validate();
          $valid = $modelNotaSalida->validate() && $valid;


          if (!$valid) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validate($model),
                    ActiveForm::validate($modelNotaSalida)
                );
            }
          } else {
            $modelPedido->estatus_pedido = 2;

            $numDoc = Numeracion::getNumeracion( $model::FACTURA_DOC,$model->tipo_doc );
            $codigoDoc = intval( $numDoc['numero_num'] ) + 1;
            $codigoDoc = str_pad($codigoDoc,10,'0',STR_PAD_LEFT);

            $transaction = \Yii::$app->db->beginTransaction();
            $model->cod_doc = $codigoDoc;
            $model->numeracion_doc = $numDoc[ 'id_num' ];
            $flag = $model->save();
            $flag = $modelPedido->save() && $flag;

            $model->valorr_doc = SiteController::getEmpresa()->ruc_empresa ."|". $tipoDoc ."|".$model->tipoDoc->abrv_tipod . $model->numeracion->serie_num . "|";
            $model->valorr_doc .= substr($model->cod_doc,-8) . "|" . $model->totalimp_doc . "|" . $model->total_doc ."|". $model->fecha_doc . "|" . $tipoDocClte . "|" . $docClte ;

//            $model->hash_doc = base64_encode(hash( 'sha1', $model->valorr_doc, false ));
            $model->tipocambio_doc = TipoCambio::getTipoCambio()->valorf_tipoc;

            try {
              $modelNotaSalida->idrefdoc_trans = $model->id_doc;
              $modelNotaSalida->status_trans = $modelNotaSalida::STATUS_APPROVED;
              $flag = $modelNotaSalida->save() && $flag;
              if ( $flag ) {
                for($i = 0; $i < count($notaSalidaDetalle); $i++) {
                      $modelNotaSalidaDetalle = new NotaSalidaDetalle();
                      $modelNotaSalidaDetalle->trans_detalle = $modelNotaSalida->id_trans;
                      $modelNotaSalidaDetalle->prod_detalle = $notaSalidaDetalle[$i]['prod_detalle'];
                      $modelNotaSalidaDetalle->cant_detalle = $notaSalidaDetalle[$i]['cant_detalle'];

                      if ( !($flag = $modelNotaSalidaDetalle->save()) ) {
                          $transaction->rollBack();
                          throw new \Exception("Error Processing Request", 1);
                          break;
                      }

                      $producto = Producto::findOne(['id_prod' => $notaSalidaDetalle[$i]['prod_detalle']]);
                      $producto->stock_prod -= $notaSalidaDetalle[$i]['cant_detalle'];

                      if (! ($flag = $producto->save(false))) {
                          $transaction->rollBack();
                          throw new \Exception("Error Processing Request", 1);
                          break;
                      }
                  }

                  $flag = $model->save() && $flag;
              }

              $numeracion = Numeracion::findOne($num['id_num']);
              $numeracion->numero_num = $codigo;
              $flag = $numeracion->save() && $flag;

              $numeracion = Numeracion::findOne($numDoc['id_num']);
              $numeracion->numero_num = $codigoDoc;
              $flag = $numeracion->save() && $flag;

              if ( $flag ) {
                $transaction->commit();
                Yii::$app->response->format = Response::FORMAT_JSON;
                $return = [
                  'success' => true,
                  'title' => Yii::t('documento', 'Document'),
                  'id' => $model->id_doc,
                  'message' => Yii::t('app','Record has been saved successfully!'),
                  'type' => 'success'
                ];
                return $return;
              }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                $return = [
                  'success' => false,
                  'title' => Yii::t('salida', 'Exit note'),
                  'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                  'type' => 'error'
                ];
                return $return;
            }
          }
        }

        $this->layout = 'justStuff';
        return $this->render('_formDocumento', [
            'model' => $model,
            'modelPedido' => $modelPedido,
            'IMPUESTO' => $IMPUESTO,
        ]);
    }

    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGuiaCreate( $id )
    {
        $model = new Documento();
        $model->scenario = Documento::SCENARIO_GUIA;
        $modelPedido = Pedido::findOne( $id );

        if ( $modelPedido === null) {
            throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
        }

        $post = Yii::$app->request->post();


        if ($model->load($post)) {
          $modelDocumentoDetalle = [new DocumentoDetalle()];

          $documentoDetalle = [];
          foreach ($post['PedidoDetalle'] as $key => $value) {
            $documentoDetalle[$key] = ['prod_detalle' => $value['prod_pdetalle'],'cant_detalle' => $value['cant_pdetalle']];
          }

          $fecha = explode("/",$model->fecha_doc);
          $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
          $model->fecha_doc = $fecha;
          $modelPedido->estatus_pedido = $modelPedido::GUIA_GENERADA;
          $model->status_doc = $model::GUIA_GENERADA;
          $model->almacen_doc = $modelPedido->almacen_pedido;
          $model->sucursal_doc = SiteController::getSucursal();

          // validate all models
          $valid = $model->validate();

          if (!$valid) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return
                    ActiveForm::validate($model);
            }
          } else {

            $numDoc = Numeracion::getNumeracion( $model::GUIA_DOC,$model->tipo_doc );
            $codigoDoc = intval( $numDoc['numero_num'] ) + 1;
            $codigoDoc = str_pad($codigoDoc,10,'0',STR_PAD_LEFT);
            $model->numeracion_doc = $numDoc[ 'id_num' ];

            $transaction = \Yii::$app->db->beginTransaction();
            try {
              $model->cod_doc = $codigoDoc;
              $flag = $model->save();
              $flag = $modelPedido->save() && $flag;

              if ( $flag ) {
                for($i = 0; $i < count($documentoDetalle); $i++) {
                      $modelDocumentoDetalle = new DocumentoDetalle();
                      $modelDocumentoDetalle->documento_ddetalle = $model->id_doc;
                      $modelDocumentoDetalle->prod_ddetalle = $documentoDetalle[$i]['prod_detalle'];
                      $modelDocumentoDetalle->cant_ddetalle = $documentoDetalle[$i]['cant_detalle'];

                      if ( !($flag = $modelDocumentoDetalle->save()) ) {
                          $transaction->rollBack();
                          throw new \Exception("Error Processing Request", 1);
                          break;
                      }
                  }
              }

              $numeracion = Numeracion::findOne($numDoc['id_num']);
              $numeracion->numero_num = $codigoDoc;
              $flag = $numeracion->save() && $flag;

              if ( $flag ) {
                $transaction->commit();
                Yii::$app->response->format = Response::FORMAT_JSON;
                $return = [
                  'success' => true,
                  'title' => Yii::t('documento', 'Document'),
                  'id' => $model->id_doc,
                  'message' => Yii::t('app','Record has been saved successfully!'),
                  'type' => 'success'
                ];
                return $return;
              }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                $return = [
                  'success' => false,
                  'title' => Yii::t('salida', 'Exit note'),
                  'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                  'type' => 'error'
                ];
                return $return;
            }
          }
        }

        $this->layout = 'justStuff';
        return $this->render('_formGuia', [
            'model' => $model,
            'modelPedido' => $modelPedido,
            'IMPUESTO' => SiteController::getImpuesto(),
        ]);
    }

    public function actionListadoFactura()
    {
        $searchModel = new DocumentoSearch();
        $dataProvider = $searchModel->searchDocumento(Yii::$app->request->queryParams);


        return $this->render('_facturaGenerada', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGuiaRpt( $id ) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      $modelDocumento = Documento::find()
                        ->where('id_doc = :id',[ ':id' => $id])
                        ->andWhere(['tipo_doc' => Documento::TIPODOC_GUIA])->one();

      if ( is_null($modelDocumento) ){
        throw new NotFoundHttpException(Yii::t('empresa', 'The requested page does not exist.'));
      }

      $this->layout = 'reports';
      $modelDetalle = $modelDocumento->detalles;

      $content = $this->render('guiaRpt', [
          'guia' => $modelDocumento,
      ]);


      $pdf = Yii::$app->pdf; // or new Pdf();
      //$pdf->cssFile = "@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css";
      $mpdf = $pdf->api; // fetches mpdf api

      $f = Yii::$app->formatter;
      $date = $f->asDate($modelDocumento->fecha_doc, 'php:d/m/Y');

      $header = '
      <table class="datos-cliente" style="margin: 0px 0 15px 0;">
          <tr>
              <td width="15%">&nbsp;</td>
              <td width="25%" class="left">'.$date.'</td>
              <td width="10%">&nbsp;</td>
              <td width="35%" class="left">'.$date.'</td>
              <td width="25%">&nbsp;</td>
          </tr>
      </table>
      <table style="margin: 0px 0 24px 0;">
        <tr>
          <td class="left" style="padding:3px 100px"> ' . strtoupper(SiteController::getEmpresa()->direcc_empresa) . ' </td>
        </tr>
        <tr>
          <td class="left " style="padding:3px 100px"> ' . strtoupper($modelDocumento->pedidoDoc->cltePedido->direcc_clte) . ' </td>
        </tr>
      </table>
      <table style="margin: 0px 0 0px 0;">
        <tr>
          <td  width="80%" class="left celdas" style="padding-left:50px">' . $modelDocumento->pedidoDoc->cltePedido->nombre_clte . '</td>
          <td  width="20%" class="left celdas" >' . $modelDocumento->unidadTransporte->des_utransp  . '</td>
        </tr>
        <tr>
          <td class="left celdas"  style="padding-left:50px">' . $modelDocumento->pedidoDoc->cltePedido->ruc_clte . '</td>
          <td class="left celdas">&nbsp;</td>
        </tr>
      </table>
      ';

      $footer = '
      <table class="datos-cliente" style="margin: 0px 0 55px 0;">
          <tr>
              <td style="padding-left:50px" class="left">'.$modelDocumento->transportista->des_transp.'</td>
          </tr>
          <tr>
              <td style="padding-left:50px; padding-top: 5px;" class="left">'.$modelDocumento->transportista->ruc_transp.'</td>
          </tr>
      </table>';

      //$content = "Hi";
      $sheet = file_get_contents( Yii::getAlias( '@rptcss' ).'/rptCss.css' );
      $mpdf->WriteHTML( $sheet, 1 );
      //$mpdf->marginTop = 120;

      $mpdf->SetHTMLHeader( $header ); // call methods or set any properties
      $mpdf->AddPage('P','','','','',10,10,100,50,50,12);
      $mpdf->WriteHtml( $content ); // call mpdf write html
      $mpdf->SetHTMLFooter( $footer );

      $titulo = $modelDocumento->cod_doc. '-'. Yii::t('documento','Referral guide') .'-'.$modelDocumento->pedidoDoc->cltePedido->nombre_clte.'.pdf';

      $mpdf->SetTitle($titulo);
      $mpdf->Output($titulo, 'I'); // call the mpdf api output as needed
    }

    public function actionDocumentoRpt( $id ) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      $modelDocumento = Documento::find()
                                   ->where('id_doc = :id',[':id' => $id])
                                   ->andWhere(['tipo_doc' => [Documento::TIPODOC_FACTURA,Documento::TIPODOC_BOLETA]])->one();

      if ( is_null($modelDocumento) ){
        throw new NotFoundHttpException(Yii::t('empresa', 'The requested page does not exist.'));
      }
      $this->layout = 'reports';


      $content = $this->render('documentoRpt', [
          'documento' => $modelDocumento,
          'IMPUESTO' => SiteController::getImpuesto(),
          'rucEmpresa' => SiteController::getEmpresa()->ruc_empresa,
      ]);


      $pdf = Yii::$app->pdf; // or new Pdf();
      // $pdf->cssFile = "@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css";
      $mpdf = $pdf->api; // fetches mpdf api

      $f = Yii::$app->formatter;
      $date = $f->asDate($modelDocumento->fecha_doc, 'php:d/m/Y');

      $nroComprobante = $modelDocumento->tipoDoc->abrv_tipod . $modelDocumento->numeracion->serie_num . "-" . substr($modelDocumento->cod_doc,-8);

      $header = '
      <table class="documento_enc" style="border-collapse: collapse;">
          <tr>
              <td width="25%">
                <div class="rounded"> <img src="'.Url::base().'/img/logo.jpg'.'" width="180px"/> </div>
              </td>
              <td width="50%" align="center" >
                <div class="titulo-emp" style="font-size:20px;font-weight:bold;">' . SiteController::getEmpresa()->nombre_empresa . '</div><br>
                <div class="datos-emp">' . SiteController::getEmpresa()->direcc_empresa . '</div>
                <div class="datos-emp">' . SiteController::getEmpresa()->tlf_empresa . '</div>
                <div class="datos-emp">' . SiteController::getEmpresa()->movil_empresa . '</div>
                <div class="datos-emp">' . SiteController::getEmpresa()->correo_empresa . '</div>
              </td>
              <td width="25%" style="border:1px solid black;text-align:center;font-weight:bold;">
                <div style="margin: 70px auto;"> R.U.C. ' . SiteController::getEmpresa()->ruc_empresa . '</div><br>
                <div style="font-size:18px"> ' . $modelDocumento->tipoDoc->des_tipod. ' </div><br>
                <div style="margin: 70px auto;"> N° ' . $nroComprobante . '</div>
              </td>
          </tr>
      </table>
      <br>
      <table class="datos_documento" border="1">
        <tr>
          <td width="20%" align="right" style="font-weight:bold;">'.Yii::t('cliente','Customer').'</td>
          <td> &nbsp;' . $modelDocumento->pedidoDoc->cltePedido->nombre_clte . '</td>
        </tr>
        <tr>
          <td align="right" style="font-weight:bold;">'.Yii::t('cliente','R.U.C.').'</td>
          <td> &nbsp;' . $modelDocumento->pedidoDoc->cltePedido->ruc_clte . '</td>
        </tr>
        <tr>
          <td align="right" style="font-weight:bold;border:1px solid black">'.Yii::t('cliente','Address').'</td>
          <td> &nbsp;' . $modelDocumento->pedidoDoc->cltePedido->direcc_clte . '</td>
        </tr>
      </table>
      <table class="datos_documento" border="1">
        <tr>
          <td align="center" width="25%" style="font-weight:bold">'.Yii::t('documento','Emission date').'</td>
          <td align="center" width="25%" style="font-weight:bold">'.Yii::t('pedido','Order').'</td>
          <td align="center" width="25%" style="font-weight:bold">'.Yii::t('condicionp','Payment condition').'</td>
          <td align="center" width="25%" style="font-weight:bold">'.Yii::t('documento','Referral guide').'</td>
        </tr>
        <tr>
          <td align="center">'.$date.'</td>
          <td align="center">'.$modelDocumento->pedidoDoc->nrodoc_pedido.'</td>
          <td align="center">'.$modelDocumento->pedidoDoc->condpPedido->desc_condp.'</td>
          <td align="center">'.$modelDocumento->guiaRem->tipoDoc->abrv_tipod . $modelDocumento->guiaRem->numeracion->serie_num .'-'.substr($modelDocumento->guiaRem->cod_doc,-8).'</td>
        </tr>
      </table>';

      $sheet = file_get_contents( Yii::getAlias( '@rptcss' ).'/rptCss.css' );
      $mpdf->WriteHTML( $sheet, 1 );
      $mpdf->charset_in = 'UTF-8';

      $mpdf->SetHTMLHeader( $header ); // call methods or set any properties
      $mpdf->AddPage('P','','','','',10,10,80,50,10,5);
      $mpdf->WriteHtml( $content ); // call mpdf write html

      $titulo =  $nroComprobante .'-'.$modelDocumento->pedidoDoc->cltePedido->nombre_clte.'.pdf';

      $mpdf->SetTitle($titulo);
      $mpdf->Output($titulo, 'I'); // call the mpdf api output as needed
    }

    function actionAjaxGenFactXml( $id = 28 ){

      $model = Documento::find()
                           ->where('id_doc = :id',[':id' => $id])
                           ->andWhere(['tipo_doc' => [Documento::TIPODOC_FACTURA,Documento::TIPODOC_BOLETA]])
                           ->andWhere(['status_doc' => [Documento::DOCUMENTO_GENERADO]])
                           ->one();

      $empresa = SiteController::getEmpresa();
      $IMPUESTO = SiteController::getImpuesto();

      $see = new See();
      $see->setService(SunatEndpoints::FE_BETA);
      $see->setCertificate(file_get_contents('../C19110619915.pem'));
      $see->setCredentials('20604954241MODDATOS', 'moddatos');


      // Cliente
      $client = new Client();
      $client->setTipoDoc('6')
          ->setNumDoc($model->pedidoDoc->cltePedido->ruc_clte)
          ->setRznSocial($model->pedidoDoc->cltePedido->nombre_clte);

      // Emisor
      $address = new Address();
      $address->setUbigueo('150132')
          ->setDepartamento('LIMA')
          ->setProvincia('LIMA')
          ->setDistrito('SAN JUAN DE LURIGANCHO')
          ->setUrbanizacion('NONE')
          ->setDireccion('JR. LAS ALCAPARRAS NRO. 467 URB. LAS FLORES - LIMA LIMA SAN JUAN DE LURIGANCHO');

      $company = new Company();
      $company->setRuc( $empresa->ruc_empresa )
          ->setRazonSocial( $empresa->nombre_empresa )
          ->setNombreComercial($empresa->nombre_empresa)
          ->setAddress($address);

      $subtotal =  $model->total_doc / 1 + ( $IMPUESTO / 100);
      $subtotal = number_format( $subtotal,2,'.','');
      $impuesto = $subtotal * ($IMPUESTO / 100);
      $impuesto = number_format( $impuesto,2,'.','');
      // Venta
      $invoice = (new Invoice())
          ->setUblVersion('2.1')
          ->setTipoOperacion('0101') // Catalog. 51
          ->setTipoDoc('01')
          ->setSerie( $model->tipoDoc->abrv_tipod.$model->numeracion->serie_num)
          ->setCorrelativo(substr($model->cod_doc,-8))
          ->setFechaEmision(new DateTime($model->fecha_doc))
          ->setTipoMoneda($model->pedidoDoc->monedaPedido->sunatm_moneda)
          ->setClient($client)
          ->setMtoOperGravadas( $subtotal ) //Subtotal sin IGV
          ->setMtoIGV( $IMPUESTO ) // Monto de IGV
          ->setTotalImpuestos( $model->totalimp_doc )
          ->setValorVenta( $subtotal )
          ->setSubTotal( $model->total_doc )
          ->setMtoImpVenta( $model->total_doc)
          ->setCompany($company);

      foreach ($model->pedidoDoc->detalles as $key => $value) {
        // code...
        $totalSIGV = number_format($value->total_pdetalle / (1 + ($value->impuesto_pdetalle / 100 )), 2 , '.',''); //Total sin IGV por item
        $totalIGV = number_format($totalSIGV * ($value->impuesto_pdetalle / 100), 2, '.','');// Total de igv por item por cantidad
        $precioUnitarioSIGV = $value->precio_pdetalle /(1 + ($value->impuesto_pdetalle / 100 )); //Precio unitario sin IGV por item
        $precioUnitarioSIGV = number_format($precioUnitarioSIGV / $value->cant_pdetalle, 2, '.', '');
        $cantidad = number_format($value->cant_pdetalle, 3, '.', '');

        $item[] = (new SaleDetail())
            ->setCodProducto(trim($value->productoPdetalle->cod_prod))
            ->setUnidad($value->productoPdetalle->umedProd->sunatm_und)
            ->setCantidad(floatval($cantidad))
            ->setDescripcion(trim($value->productoPdetalle->des_prod))
            ->setMtoBaseIgv($totalSIGV) //Total por item sin IGV
            ->setPorcentajeIgv($value->impuesto_pdetalle) // 18%
            ->setIgv($totalIGV) //Total de IGV por item
            ->setTipAfeIgv('10')
            ->setTotalImpuestos($totalIGV)
            ->setMtoValorVenta($totalIGV)
            ->setMtoValorUnitario($precioUnitarioSIGV)
            ->setMtoPrecioUnitario($value->precio_pdetalle);
            // break;
      }

      // var_dump($item);
      // exit();

      $legend = (new Legend())
          ->setCode('1000')
          ->setValue(NumerosEnLetras::convertir($model->total_doc));

      $invoice->setDetails($item)
              ->setLegends([$legend]);

      $result = $see->send($invoice);

      // Guardar XML
      file_put_contents(Yii::getAlias('@app') . '/xml/sent/' . $invoice->getName().'.xml',
                        $see->getFactory()->getLastXml());
      $model->statussunat_doc = $result->getCdrResponse()->getCode();
      $model->save();

      $return = [
          'description' => $result->getCdrResponse()->getDescription(),
          'code' => $result->getCdrResponse()->getCode(),
          'id' => $result->getCdrResponse()->getId(),
          ];

      foreach ($result->getCdrResponse()->getNotes() as $key => $value){
            $return['notes'][$key] = $value;
      }
      echo json_encode($return);
      // Guardar CDR
      file_put_contents(Yii::getAlias('@app') . '/xml/response/' . 'R-'.$invoice->getName().'.zip', $result->getCdrZip());
      /*

      if ( is_null($model) ){
        throw new NotFoundHttpException(Yii::t('empresa', 'The requested page does not exist.'));
      }
      $xml = new DOMDocument( "1.0", "ISO-8859-1"); // Crea el documento

      $Invoice = $xml->createElement( 'Invoice' ); // Crea el Invoice
      $Invoice->setAttribute( 'xmlns', "urn:oasis:names:specification:ubl:schema:xsd:Invoice-2");
      $Invoice->setAttribute( 'xmlns:cac', "urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2");
      $Invoice->setAttribute( 'xmlns:cbc', "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2");
      $Invoice->setAttribute( 'xmlns:ccts',"urn:un:unece:uncefact:documentation:2");
      $Invoice->setAttribute( 'xmlns:ds', "http://www.w3.org/2000/09/xmldsig#");
      $Invoice->setAttribute( 'xmlns:ext',"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2");
      $Invoice->setAttribute( 'xmlns:qdt',"urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2");
      $Invoice->setAttribute( 'xmlns:sac',"urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1");
      $Invoice->setAttribute( 'xmlns:udt',"urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2");
      $Invoice->setAttribute( 'xmlns:xsi',"http://www.w3.org/2001/XMLSchema-instance");
        // *************************************************************************************************
        $ublVersion = $xml->createElement( 'cbc:UBLVersionID', '2.0' );// Crea la version del xml
        // *************************************************************************************************
        $ublCustomizationID = $xml->createElement( 'cbc:CustomizationID', '1.0' );// Id de customizacion
        // *************************************************************************************************
        $issueDate = $xml->createElement( 'cbc:IssueDate', $model->fecha_doc);//Fecha
        // *************************************************************************************************
        $accountingSupplierParty = $xml->createElement('cac:AccountingSupplierParty'); //Crea AccountingSupplierParty (DATOS DEL EMISOR)
          // *************************************************************************************************
          $customerAssignedAccountID = $xml->createElement('cbc:CustomerAssignedAccountID', $empresa->ruc_empresa); //Ruc emisor
          // *************************************************************************************************
          $additionalAccountID = $xml->createElement('cbc:AdditionalAccountID',6);//Tipo de documento emisor
          // *************************************************************************************************
          $party = $xml->createElement( "cac:Party" ); //Datos de razon social y direccion del emisor
            $partyName = $xml->createElement( "cac:PartyName" ); //Elemento padre de razon social
              $partyName_name = $xml->createElement( 'cbc:Name' );      //  Elemento padre de CDATA
                $cDataName = $xml->createCDATASection( $empresa->nombre_empresa ); // CDATA razonSocial
            // Añadiendo datos de razon social
              $partyName_name->appendChild( $cDataName);
            $partyName->appendChild( $partyName_name );
            // *************************************************************************************************
            $postalAddress = $xml->createElement('cac:PostalAddress');// Datos de direccion del emisor
              $postalAddress_id = $xml->createElement( 'cbc:ID',150132 ); // Ubigeo emisor
              $postalAddress_streetname = $xml->createElement( 'cbc:StreetName','JR. LAS ALCAPARRAS NRO. 467 URB. LAS FLORES - LIMA LIMA SAN JUAN DE LURIGANCHO'); //Direccion del emisor
              $postalAddress_CitySubdivisionName = $xml->createElement( 'cbc:CitySubdivisionName' );
              $postalAddress_CityName = $xml->createElement( 'cbc:CityName', 'Llima'); //Departamento del emisor
              $postalAddress_CountrySubentity = $xml->createElement( 'cbc:CountrySubentity', 'Llima'); //Provincia del emisor
              $postalAddress_District = $xml->createElement( 'cbc:District', 'San Juan de Lurigancho'); //Distrito del emisor
              $postalAddress_Country = $xml->createElement( 'cbc:Country', 'PE'); //Pais del emisor
            // *************************************************************************************************
            //Añadiendo datos de PostalAddress
            $postalAddress->appendChild( $postalAddress_id );
            $postalAddress->appendChild( $postalAddress_streetname );
            $postalAddress->appendChild( $postalAddress_CitySubdivisionName );
            $postalAddress->appendChild( $postalAddress_CityName );
            $postalAddress->appendChild( $postalAddress_CountrySubentity );
            $postalAddress->appendChild( $postalAddress_District );
            $postalAddress->appendChild( $postalAddress_Country );
          // *************************************************************************************************
          $partyLegalEntity = $xml->createElement( 'cac:PartyLegalEntity'); //Datos de nombre comercial del emisor
            $partyLegalEntity_RegistrationName = $xml->createElement( 'cbc:RegistrationName');
              $cDataRegistrationName = $xml->createCDATASection( $empresa->nombre_empresa ); // CDATA razonSocial
          //Añadiendo datos
            $partyLegalEntity_RegistrationName->appendChild( $cDataRegistrationName );
          $partyLegalEntity->appendChild( $partyLegalEntity_RegistrationName );
          // *************************************************************************************************
          //Añadiendo datos a Party
          $party->appendChild( $partyName );
          $party->appendChild( $postalAddress );
          $party->appendChild( $partyLegalEntity );
        // Añadiendo datos del emisor
        $accountingSupplierParty->appendChild( $customerAssignedAccountID );
        $accountingSupplierParty->appendChild( $additionalAccountID );
        $accountingSupplierParty->appendChild( $party );
        $accountingSupplierParty->appendChild($postalAddress);
      // *************************************************************************************************
      $invoiceTypeCode = $xml->createElement('cbc:InvoiceTypeCode',($model->tipo_doc == 3) ? 1 : 3); //Tipo de documento
      // *************************************************************************************************
      $cbcId = $xml->createElement( 'cbc:ID', $model->tipoDoc->abrv_tipod . $model->numeracion->serie_num .'-'.substr($model->cod_doc,-8)); // Numero de documento Serie-Numeracion
      // *************************************************************************************************
      $accountingCustomerParty = $xml->createElement( 'cac:AccountingCustomerParty' ); //Datos de cliente
        $customerAssignedAcountId = $xml->createElement( 'cbc:CustomerAssignedAccountID', $model->pedidoDoc->cltePedido->ruc_clte); // Ruc de Cliente
        $customer_additionalAccountID = $xml->createElement( 'cbc:AdditionalAccountID', $model->pedidoDoc->cltePedido->tipoid_clte); // Tipo de documento usuario
        $customer_party = $xml->createElement( 'cac:Party' );
          $customer_partyLegalEntity = $xml->createElement( 'cac:PartyLegalEntity' );
            $customer_RegistrationName = $xml->createElement( 'cbc:RegistrationName' );
              $customer_cData = $xml->createCDATASection( trim($model->pedidoDoc->cltePedido->nombre_clte) ); //Razon social Cliente
            //Añadir datos
            $customer_RegistrationName->appendChild( $customer_cData );
          $customer_partyLegalEntity->appendChild( $customer_RegistrationName );
        $customer_party->appendChild( $customer_partyLegalEntity );
      $accountingCustomerParty->appendChild( $customer_party );
      // *************************************************************************************************
      $Invoice->appendChild( $ublVersion ); //Añade al Invoice
      $Invoice->appendChild( $ublCustomizationID ); //Añade al Invoice
      $Invoice->appendChild( $issueDate ); //Añade al Invoice
      $Invoice->appendChild( $accountingSupplierParty ); //Añade al Invoice
      $Invoice->appendChild( $invoiceTypeCode ); // Añade al invoice
      $Invoice->appendChild( $cbcId ); // Añade al invoice
      $Invoice->appendChild( $accountingCustomerParty ); // Añade al invoice
      // *************************************************************************************************
      $total = 0;
      foreach ($model->pedidoDoc->detalles as $key => $value) {

        // *************************************************************************************************
        $invoiceLine = $xml->createElement('cac:InvoiceLine');

          $invoiceLine_ID = $xml->createElement('cac:ID', $key + 1);//Id de orden en la factura
          $invoiceLine_InvoicedQuantity = $xml->createElement('cbc:InvoicedQuantity',$value->cant_pdetalle);//Cantidad por item con unidad de medida
          $invoiceLine_InvoicedQuantity->setAttribute('unitCode',$value->productoPdetalle->umedProd->sunatm_und); // Atributo de unidad de medida
          $invoiceLine_price = $xml->createElement('cac:Price');// Precio unitario sin IGV y sin Descuento
            $igv = $value->impuesto_pdetalle / 100;
            $igv = number_format($igv, 2, '.', '');
            $precioUnitario = ($value->precio_pdetalle /( 1 + $igv));
            $precioUnitario = number_format($precioUnitario, 2, '.', '');
            $priceAmount = $xml->createElement('cbc:PriceAmount',$precioUnitario);
            $priceAmount->setAttribute('currencyID',$model->pedidoDoc->monedaPedido->sunatm_moneda);
            //Añadir a $invoiceLine_price
            $invoiceLine_price->appendChild($priceAmount);

          $invoiceLine_item = $xml->createElement('cac:Item');
            $sellersItemIdentification = $xml->createElement( 'cac:SellersItemIdentification');
              $item_cbcId = $xml->createElement( 'cbc:ID', $value->productoPdetalle->cod_prod); //Codigo de Item
              //Añadir DAtos
              $sellersItemIdentification->appendChild($item_cbcId);
            $invoiceLine_item->appendChild($sellersItemIdentification);

            $invoiceLine_description = $xml->createElement( 'cbc:Description' );
              $description_cData = $xml->createCDATASection( trim($value->productoPdetalle->des_prod) ); //Descripcion del item
              //Añadir datos
              $invoiceLine_description->appendChild($description_cData);
            $invoiceLine_item->appendChild($invoiceLine_description);

          $invoiceLine_pricingReference = $xml->createElement( 'cac:PricingReference' );
            $pricingRef_alternativeCP = $xml->createElement( 'cac:AlternativeConditionPrice' );
              $priceAmount = $xml->createElement( 'cbc:PriceAmount', $value->precio_pdetalle ); //Precio unitario con igv por item
              $priceAmount->setAttribute( 'currencyID', $model->pedidoDoc->monedaPedido->sunatm_moneda);
              $priceTypeCode = $xml->createElement( 'cbc:PriceTypeCode', 01 ); //Tipo de IGV por item
              //Añadir datos
              $pricingRef_alternativeCP->appendChild( $priceAmount );
              $pricingRef_alternativeCP->appendChild( $priceTypeCode );

          $invoiceLine_taxTotal = $xml->createElement( 'cac:TaxTotal' );
            $ivTTotal_taxAmount = $xml->createElement( 'cbc:TaxAmount', number_format($precioUnitario * $igv,2,'.','')); //Total de IGV por item
            $ivTTotal_taxAmount->setAttribute('currencyID', $model->pedidoDoc->monedaPedido->sunatm_moneda);
            //Añadir datos
            $invoiceLine_taxTotal->appendChild( $ivTTotal_taxAmount );

            $ivTTotal_taxSubtotal = $xml->createElement( 'cac:TaxSubtotal' );
              $ivTTotal_taxSubtotal_taxAmount = $xml->createElement( 'cbc:TaxAmount',  number_format($precioUnitario * $igv,2,'.','')); //Total de IGV por item
              $ivTTotal_taxSubtotal_taxAmount->setAttribute('currencyID', $model->pedidoDoc->monedaPedido->sunatm_moneda);
              //Añadir datos
              $ivTTotal_taxSubtotal->appendChild( $ivTTotal_taxSubtotal_taxAmount );

              $ivTTotal_taxCategory = $xml->createElement( 'cac:TaxCategory' );
                $ivTTotal_taxCategory_TERC = $xml->createElement( 'cbc:TaxExemptionReasonCode', 10);
                $ivTTotal_taxCategory_taxScheme = $xml->createElement( 'cac:TaxScheme' );
                  $ivTTotal_taxCategory_taxScheme_id = $xml->createElement( 'cbc:ID',1000);
                  $ivTTotal_taxCategory_taxScheme_name = $xml->createElement( 'cbc:Name','IGV');
                  $ivTTotal_taxCategory_taxScheme_typeCode = $xml->createElement( 'cbc:TaxTypeCode','VAT');
                  //Añadir datos
                  $ivTTotal_taxCategory_taxScheme->appendChild($ivTTotal_taxCategory_taxScheme_id);
                  $ivTTotal_taxCategory_taxScheme->appendChild($ivTTotal_taxCategory_taxScheme_name);
                  $ivTTotal_taxCategory_taxScheme->appendChild($ivTTotal_taxCategory_taxScheme_typeCode);
                $ivTTotal_taxCategory->appendChild(  $ivTTotal_taxCategory_TERC);
                $ivTTotal_taxCategory->appendChild(  $ivTTotal_taxCategory_taxScheme);
              $ivTTotal_taxSubtotal->appendChild($ivTTotal_taxCategory);
            $invoiceLine_taxTotal->appendChild($ivTTotal_taxSubtotal);
          $invoiceLine_LineExtAmo = $xml->createElement( 'cbc:LineExtensionAmount', number_format($precioUnitario * $value->cant_pdetalle,2,'.',''));// Total de Precio unitario por item menos el descuento sin IGV por item
          //Añadir DAtos
          $invoiceLine->appendChild( $invoiceLine_ID );
          $invoiceLine->appendChild( $invoiceLine_InvoicedQuantity );
          $invoiceLine->appendChild( $invoiceLine_price );
          $invoiceLine->appendChild( $invoiceLine_item );
          $invoiceLine->appendChild( $invoiceLine_pricingReference );
          $invoiceLine->appendChild( $invoiceLine_taxTotal );
          $invoiceLine->appendChild( $invoiceLine_LineExtAmo );

        $Invoice->appendChild( $invoiceLine );

      }
      $subtotal = $model->total_doc / ( 1 + ($IMPUESTO / 100));
      $subtotal = number_format($subtotal,2,'.','');

      $ublExtension = $xml->createElement( 'ext:UBLExtension' );
        $ublExt_extensionContent = $xml->createElement( 'ext:ExtensionContent' );
          $ublExt_extensionContent_AddInfo = $xml->createElement( 'sac:AdditionalInformation' );
            $additionalMonetaryTotal = $xml->createElement( 'sac:AdditionalMonetaryTotal' );
              $additionalMonetaryTotal_id = $xml->createElement( 'cbc:ID',1001);
              $additionalMonetaryTotal_payableAmount = $xml->createElement( 'cbc:PayableAmount',$subtotal);// Total de valor de ventas sin IGV
              $additionalMonetaryTotal_payableAmount->setAttribute('currencyID',$model->pedidoDoc->monedaPedido->sunatm_moneda);
              //Añadir datos
              $additionalMonetaryTotal->appendChild( $additionalMonetaryTotal_id);
              $additionalMonetaryTotal->appendChild( $additionalMonetaryTotal_payableAmount);

            $additionalProperty = $xml->createElement( 'sac:AdditionalProperty' );
              $additionalProperty_id = $xml->createElement( 'cbc:ID',1001 );
              $additionalProperty_value = $xml->createElement('cbc:Value', NumerosEnLetras::convertir($total)); //Total en letras
              //Añadir datos
              $additionalProperty->appendChild( $additionalProperty_id);
              $additionalProperty->appendChild( $additionalProperty_value);
            $ublExt_extensionContent_AddInfo->appendChild( $additionalMonetaryTotal);
            $ublExt_extensionContent_AddInfo->appendChild( $additionalProperty);
          $ublExt_extensionContent->appendChild( $ublExt_extensionContent_AddInfo);
        $ublExtension->appendChild( $ublExt_extensionContent);

        $taxtotal = $xml->createElement( 'cac:TaxTotal');
          $taxtotal_taxAmount = $xml->createElement( 'cbc:TaxAmount', $model->totalimp_doc);//Total de impuesto del documento
          $taxtotal_taxAmount->setAttribute('currencyID',$model->pedidoDoc->monedaPedido->sunatm_moneda);
          $taxtotal_TaxSubtotal = $xml->createElement( 'cac:TaxSubtotal' );
            $taxtotal_TaxSubtotal_taxAmount = $xml->createElement( 'cbc:TaxAmount', $model->totalimp_doc);//Total de impuesto del documento
            $taxtotal_TaxSubtotal_taxAmount->setAttribute('currencyID',$model->pedidoDoc->monedaPedido->sunatm_moneda);
            $taxtotal_TaxSubtotal_taxCategory = $xml->createElement( 'cbc:TaxCategory');//Total de impuesto del documento
              $taxScheme = $xml->createElement( 'cac:TaxScheme' );
                $taxScheme_id = $xml->createElement( 'cbc:ID', 1001 );
                $taxScheme_name = $xml->createElement( 'cbc:Name', 'IGV' );
                $taxScheme_taxTypeCode = $xml->createElement( 'cbc:TaxTypeCode', 'VAT' );
                //Añadir datos
                $taxScheme->appendChild($taxScheme_id);
                $taxScheme->appendChild($taxScheme_name);
                $taxScheme->appendChild($taxScheme_taxTypeCode);
              $taxtotal_TaxSubtotal_taxCategory->appendChild($taxScheme);
            $taxtotal_TaxSubtotal->appendChild($taxtotal_TaxSubtotal_taxAmount);
            $taxtotal_TaxSubtotal->appendChild($taxtotal_TaxSubtotal_taxCategory);
          $taxtotal->appendChild($taxtotal_taxAmount);
          $taxtotal->appendChild($taxtotal_TaxSubtotal);

        $legalMonetaryTotal = $xml->createElement( 'cac:LegalMonetaryTotal' );
          $lMonTotal = $xml->createElement( 'cac:LegalMonetaryTotal' );
          //exit('Total:'.$total);
            $lMonTotal_payableAount = $xml->createElement( 'cbc:PayableAmount', $model->total_doc );//Total del monto del documento
            $lMonTotal_payableAount->setAttribute('currencyID',$model->pedidoDoc->monedaPedido->sunatm_moneda);
            //Añadir datos
            $lMonTotal->appendChild($lMonTotal_payableAount);
          $legalMonetaryTotal->appendChild($lMonTotal);

      //Añadir datos al Invoice
      $Invoice->appendChild( $ublExtension );
      $Invoice->appendChild( $taxtotal );
      $Invoice->appendChild( $legalMonetaryTotal );

      $xml->appendChild( $Invoice );//Agrega Invoice al documento
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      Yii::$app->response->headers->add('Content-Type', 'text/xml');
      file_put_contents(Url::to('@app/xml/'.$empresa->ruc_empresa.'-01-'.$model->numeracion->tipoDocumento->abrv_tipod . $model->numeracion->serie_num."-".substr($model->cod_doc,-8).".xml"), $xml->saveXML());
      $a = $xml->saveXML( );
      print $a;*/



    }

}
