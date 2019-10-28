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
use app\models\Numeracion;
use app\models\DocumentoSearch;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\base\Model;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

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
     * Displays a single Documento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Documento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_doc]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_doc]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
            $flag = $model->save();
            $flag = $modelPedido->save() && $flag;

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
            'IMPUESTO' => SiteController::getImpuesto(),
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
        $searchModel->status_doc = Documento::DOCUMENTO_GENERADO;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('_facturaGenerada', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGuiaRpt( $id ) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      $modelDocumento = Documento::findOne($id);
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
      $modelDocumento = Documento::findOne($id);
      $this->layout = 'reports';
      $modelDetalle = $modelDocumento->detalles;

      // $content = $this->render('guiaRpt', [
      //     'guia' => $modelDocumento,
      // ]);


      $pdf = Yii::$app->pdf; // or new Pdf();
      $pdf->cssFile = "@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css";
      $mpdf = $pdf->api; // fetches mpdf api

      $f = Yii::$app->formatter;
      $date = $f->asDate($modelDocumento->fecha_doc, 'php:d/m/Y');

      $header = '
      <table class="documento_enc" style="">
          <tr>
              <td width="33.33%">
                <div class="rounded"> <img src="'.Url::base().'/img/logo.jpg'.'" width="160px"/> </div>

              </td>
              <td width="33.33%" align="center">
                <div>' . SiteController::getEmpresa()->nombre_empresa . '</div>
                <br>
                <div>' . SiteController::getEmpresa()->direcc_empresa . '</div>
                <br>
                <div>' . SiteController::getEmpresa()->tlf_empresa . '</div>
                <br>
                <div>' . SiteController::getEmpresa()->movil_empresa . '</div>
                <br>
                <div>' . SiteController::getEmpresa()->correo_empresa . '</div>
              </td>
              <td width="33.33%">&nbsp;</td>
          </tr>
      </table>';

      $content = "Hi";
      $sheet = file_get_contents( Yii::getAlias( '@rptcss' ).'/rptCss.css' );
      $mpdf->WriteHTML( $sheet, 1 );
      //$mpdf->marginTop = 120;

      $mpdf->SetHTMLHeader( $header ); // call methods or set any properties
      $mpdf->AddPage('P','','','','',10,10,100,50,10,12);
      $mpdf->WriteHtml( $content ); // call mpdf write html
      // $mpdf->SetHTMLFooter( $footer );

      $titulo = $modelDocumento->cod_doc. '-'. Yii::t('documento','Document') .'-'.$modelDocumento->pedidoDoc->cltePedido->nombre_clte.'.pdf';

      $mpdf->SetTitle($titulo);
      $mpdf->Output($titulo, 'I'); // call the mpdf api output as needed
    }

    public function actionMpdfExample(){
      $html = '
      <html>
      <head>
      <style>
      body {font-family: sans-serif;
      	font-size: 10pt;
      }
      p {	margin: 0pt; }
      table.items {
      	border: 0.1mm solid #000000;
      }
      td { vertical-align: top; }
      .items td {
      	border-left: 0.1mm solid #000000;
      	border-right: 0.1mm solid #000000;
      }
      table thead td { background-color: #EEEEEE;
      	text-align: center;
      	border: 0.1mm solid #000000;
      	font-variant: small-caps;
      }
      .items td.blanktotal {
      	background-color: #EEEEEE;
      	border: 0.1mm solid #000000;
      	background-color: #FFFFFF;
      	border: 0mm none #000000;
      	border-top: 0.1mm solid #000000;
      	border-right: 0.1mm solid #000000;
      }
      .items td.totals {
      	text-align: right;
      	border: 0.1mm solid #000000;
      }
      .items td.cost {
      	text-align: "." center;
      }
      </style>
      </head>
      <body>

      <!--mpdf
      <htmlpageheader name="myheader">
      <table width="100%"><tr>
      <td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 14pt;">Acme Trading Co.</span><br />123 Anystreet<br />Your City<br />GD12 4LP<br /><span style="font-family:dejavusanscondensed;">&#9742;</span> 01777 123 567</td>
      <td width="50%" style="text-align: right;">Invoice No.<br /><span style="font-weight: bold; font-size: 12pt;">0012345</span></td>
      </tr></table>
      </htmlpageheader>

      <htmlpagefooter name="myfooter">
      <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
      Page {PAGENO} of {nb}
      </div>
      </htmlpagefooter>

      <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
      <sethtmlpagefooter name="myfooter" value="on" />
      mpdf-->

      <div style="text-align: right">Date: 13th November 2008</div>

      <table width="100%" style="font-family: serif;" cellpadding="10"><tr>
      <td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">SOLD TO:</span><br /><br />345 Anotherstreet<br />Little Village<br />Their City<br />CB22 6SO</td>
      <td width="10%">&nbsp;</td>
      <td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">SHIP TO:</span><br /><br />345 Anotherstreet<br />Little Village<br />Their City<br />CB22 6SO</td>
      </tr></table>

      <br />

      <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
      <thead>
      <tr>
      <td width="15%">Ref. No.</td>
      <td width="10%">Quantity</td>
      <td width="45%">Description</td>
      <td width="15%">Unit Price</td>
      <td width="15%">Amount</td>
      </tr>
      </thead>
      <tbody>
      <!-- ITEMS HERE -->
      <tr>
      <td align="center">MF1234567</td>
      <td align="center">10</td>
      <td>Large pack Hoover bags</td>
      <td class="cost">&pound;2.56</td>
      <td class="cost">&pound;25.60</td>
      </tr>
      <tr>
      <td align="center">MX37801982</td>
      <td align="center">1</td>
      <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
      <td class="cost">&pound;102.11</td>
      <td class="cost">&pound;102.11</td>
      </tr>
      <tr>
      <td align="center">MR7009298</td>
      <td align="center">25</td>
      <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
      <td class="cost">&pound;12.26</td>
      <td class="cost">&pound;325.60</td>
      </tr>
      <tr>
      <td align="center">MF1234567</td>
      <td align="center">10</td>
      <td>Large pack Hoover bags</td>
      <td class="cost">&pound;2.56</td>
      <td class="cost">&pound;25.60</td>
      </tr>
      <tr>
      <td align="center">MX37801982</td>
      <td align="center">1</td>
      <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
      <td class="cost">&pound;102.11</td>
      <td class="cost">&pound;102.11</td>
      </tr>
      <tr>
      <td align="center">MR7009298</td>
      <td align="center">25</td>
      <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
      <td class="cost">&pound;12.26</td>
      <td class="cost">&pound;325.60</td>
      </tr>
      <tr>
      <td align="center">MF1234567</td>
      <td align="center">10</td>
      <td>Large pack Hoover bags</td>
      <td class="cost">&pound;2.56</td>
      <td class="cost">&pound;25.60</td>
      </tr>
      <tr>
      <td align="center">MX37801982</td>
      <td align="center">1</td>
      <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
      <td class="cost">&pound;102.11</td>
      <td class="cost">&pound;102.11</td>
      </tr>
      <tr>
      <td align="center">MR7009298</td>
      <td align="center">25</td>
      <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
      <td class="cost">&pound;12.26</td>
      <td class="cost">&pound;325.60</td>
      </tr>
      <tr>
      <td align="center">MF1234567</td>
      <td align="center">10</td>
      <td>Large pack Hoover bags</td>
      <td class="cost">&pound;2.56</td>
      <td class="cost">&pound;25.60</td>
      </tr>
      <tr>
      <td align="center">MX37801982</td>
      <td align="center">1</td>
      <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
      <td class="cost">&pound;102.11</td>
      <td class="cost">&pound;102.11</td>
      </tr>
      <tr>
      <td align="center">MR7009298</td>
      <td align="center">25</td>
      <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
      <td class="cost">&pound;12.26</td>
      <td class="cost">&pound;325.60</td>
      </tr>
      <tr>
      <td align="center">MF1234567</td>
      <td align="center">10</td>
      <td>Large pack Hoover bags</td>
      <td class="cost">&pound;2.56</td>
      <td class="cost">&pound;25.60</td>
      </tr>
      <tr>
      <td align="center">MX37801982</td>
      <td align="center">1</td>
      <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
      <td class="cost">&pound;102.11</td>
      <td class="cost">&pound;102.11</td>
      </tr>
      <tr>
      <td align="center">MF1234567</td>
      <td align="center">10</td>
      <td>Large pack Hoover bags</td>
      <td class="cost">&pound;2.56</td>
      <td class="cost">&pound;25.60</td>
      </tr>
      <tr>
      <td align="center">MX37801982</td>
      <td align="center">1</td>
      <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
      <td class="cost">&pound;102.11</td>
      <td class="cost">&pound;102.11</td>
      </tr>
      <tr>
      <td align="center">MR7009298</td>
      <td align="center">25</td>
      <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
      <td class="cost">&pound;12.26</td>
      <td class="cost">&pound;325.60</td>
      </tr>
      <tr>
      <td align="center">MR7009298</td>
      <td align="center">25</td>
      <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
      <td class="cost">&pound;12.26</td>
      <td class="cost">&pound;325.60</td>
      </tr>
      <tr>
      <td align="center">MF1234567</td>
      <td align="center">10</td>
      <td>Large pack Hoover bags</td>
      <td class="cost">&pound;2.56</td>
      <td class="cost">&pound;25.60</td>
      </tr>
      <tr>
      <td align="center">MX37801982</td>
      <td align="center">1</td>
      <td>Womans waterproof jacket<br />Options - Red and charcoal.</td>
      <td class="cost">&pound;102.11</td>
      <td class="cost">&pound;102.11</td>
      </tr>
      <tr>
      <td align="center">MR7009298</td>
      <td align="center">25</td>
      <td>Steel nails; oval head; 30mm x 3mm. Packs of 1000.</td>
      <td class="cost">&pound;12.26</td>
      <td class="cost">&pound;325.60</td>
      </tr>
      <!-- END ITEMS HERE -->
      <tr>
      <td class="blanktotal" colspan="3" rowspan="6"></td>
      <td class="totals">Subtotal:</td>
      <td class="totals cost">&pound;1825.60</td>
      </tr>
      <tr>
      <td class="totals">Tax:</td>
      <td class="totals cost">&pound;18.25</td>
      </tr>
      <tr>
      <td class="totals">Shipping:</td>
      <td class="totals cost">&pound;42.56</td>
      </tr>
      <tr>
      <td class="totals"><b>TOTAL:</b></td>
      <td class="totals cost"><b>&pound;1882.56</b></td>
      </tr>
      <tr>
      <td class="totals">Deposit:</td>
      <td class="totals cost">&pound;100.00</td>
      </tr>
      <tr>
      <td class="totals"><b>Balance due:</b></td>
      <td class="totals cost"><b>&pound;1782.56</b></td>
      </tr>
      </tbody>
      </table>


      <div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div>


      </body>
      </html>
      ';

      // $path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
      // require_once $path . '/vendor/autoload.php';

      $pdf = Yii::$app->pdf; // or new Pdf();
      $pdf->cssFile = "@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css";
      $mpdf = $pdf->api; // fetches mpdf api

      $mpdf->AddPage([
      	'margin_left' => 20,
      	'margin_right' => 15,
      	'margin_top' => 48,
      	'margin_bottom' => 25,
      	'margin_header' => 10,
      	'margin_footer' => 10
      ]);

      $mpdf->SetProtection(array('print'));
      $mpdf->SetTitle("Acme Trading Co. - Invoice");
      $mpdf->SetAuthor("Acme Trading Co.");
      $mpdf->SetWatermarkText("Paid");
      $mpdf->showWatermarkText = true;
      $mpdf->watermark_font = 'DejaVuSansCondensed';
      $mpdf->watermarkTextAlpha = 0.1;
      $mpdf->SetDisplayMode('fullpage');

      $mpdf->WriteHTML($html);

      $mpdf->Output();
    }


}
