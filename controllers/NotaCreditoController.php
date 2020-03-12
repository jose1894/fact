<?php

namespace app\controllers;

use app\models\PedidoDetalle;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\NotaCredito;
use app\models\NotaCreditoSearch;
use app\models\NotaEntrada;
use app\models\NotaEntradaDetalle;
use app\models\DocumentoDetalle;
use app\models\Pedido;
use app\models\Producto;
use app\models\TipoCambio;
use app\models\Numeracion;
use app\models\TipoIdentificacion;
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
use app\base\Model;


/**
 * NotaCreditoController implements the CRUD actions for NotaCredito model.
 */
class NotaCreditoController extends Controller
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
     * Lists all NotaCredito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotaCreditoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Finds the NotaCredito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NotaCredito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NotaCredito::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
    }


    /**
     * Creates a new Nota Credito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NotaCredito();
        // $modelsDetalles = [new DocumentoDetalle];
        $post = Yii::$app->request->post();
        //
        //
        if ( !empty($post) ) {
          //print_r($post['NotaCredito-Detalle'][0]['check_ddetalle'] === "on" ); exit();

          $documentoAnt = NotaCredito::find([
                                              'id_doc = :doc',
                                              [':doc' => $post['NotaCredito']['id_doc']]
                                            ])->one();

          if ( $documentoAnt === null ) {
                throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
          }

          try{
                $transaction = \Yii::$app->db->beginTransaction();
                $sucursal              = SiteController::getSucursal();
                $model->pedido_doc     = $documentoAnt->pedidoDoc->id_pedido;
                $model->docref_doc     = $documentoAnt->id_doc;
                $model->fecha_doc      = date("Y") . "-" . date("m") . "-" . date("d");
                $model->totalimp_doc   = $post['impuesto'];
                $model->totaldsc_doc   = $post['descuento'];
                $model->total_doc      = $post['total'];
                $model->motivo_doc     = $post['NotaCredito']['motivo_doc'];
                $model->tipo_doc       = $post['NotaCredito']['tipod_doc'];
                $model->almacen_doc    = $post['NotaCredito']['almacen_doc'];
                $model->tipocambio_doc = TipoCambio::getTipoCambio()->valorf_tipoc;
                $model->sucursal_doc   = $documentoAnt->sucursal_doc;
                $numDoc                = Numeracion::getNumeracion( $model::NOTA_CREDITO_DOC,$model->tipo_doc );

                foreach( $numDoc as $key => $value) {
                  if ( $value['id_num'] === intval( $model->tipo_doc ) ) {
                    $codigoDoc =  $value['numero_num'] + 1;
                    $id_num    =  $value['id_num'];
                  }
                }

                $codigoDoc             = str_pad($codigoDoc,10,'0',STR_PAD_LEFT);

                if ( $documentoAnt->pedidoDoc->cltePedido->tipoIdentificacion->cod_tipoi == TipoIdentificacion::TIPO_RUC ){
                  $tipoDocClte         = TipoIdentificacion::TIPO_RUC;
                  $docClte             = $documentoAnt->pedidoDoc->cltePedido->ruc_clte;
                } else {
                  $tipoDocClte         = TipoIdentificacion::TIPO_DNI;
                  $docClte             = $documentoAnt->pedidoDoc->cltePedido->dni_clte;
                }

                $model->cod_doc        = $codigoDoc;
                $model->numeracion_doc = $id_num;
                $model->sucursal_doc   = $sucursal;
                $model->status_doc     = 1;

                if ( !($flag = $model->save()) ) {
                    $transaction->rollBack();
                    throw new \Exception("Error Processing Request", 1);
                    break;
                }

                $tipoDoc               = $model->numeracion->tipoDocumento->tipodsunat_tipod;

                $model->valorr_doc     = SiteController::getEmpresa()->ruc_empresa ."|". $tipoDoc ."|".$model->tipoDoc->abrv_tipod . $model->numeracion->serie_num . "|";
                $model->valorr_doc     .= substr($model->cod_doc,-8) . "|" . $model->totalimp_doc . "|" . $model->total_doc ."|". $model->fecha_doc . "|" . $tipoDocClte . "|" . $docClte ;

                if ( $post['NotaCredito']['tipom_doc'] == $model::REPONER_STOCK ){
                  $modelNotaEntrada                 = new NotaEntrada();
                  $modelNotaEntrada->sucursal_trans = $sucursal;
                  $modelNotaEntrada->usuario_trans  = Yii::$app->user->id;
                  $modelNotaEntrada->ope_trans      = $modelNotaSalida::OPE_TRANS;
                  $num                              = Numeracion::getNumeracion( $modelNotaEntrada::NOTA_ENTRADA );
                  $codigo                           = intval( $num[0]['numero_num'] ) + 1;
                  $codigo                           = str_pad($codigo,10,'0',STR_PAD_LEFT);
                  $modelNotaEntrada->codigo_trans   = $codigo;
                  $modelNotaEntrada->tipo_trans     = $model::TIPO_NCREDITO;
                  $modelNotaEntrada->almacen_trans  = $post['NotaCredito']['almacen_doc'];
                  $modelNotaEntrada->fecha_trans    = $model->fecha_doc;
                  $modelNotaEntrada->idrefdoc_trans = $model->id_doc;
                  $modelNotaEntrada->status_trans = $modelNotaEntrada::STATUS_APPROVED;
                  $flag = $modelNotaEntrada->save() && $flag;
                }

                if ( $flag ) {
                  foreach ($post['NotaCredito-Detalle'] as $key => $value) {
                    // code...
                    $modelsDetalles   = new DocumentoDetalle();
                    if ( $value['check_ddetalle'] === "on" ) {
                      $modelsDetalles->prod_ddetalle      = $value->prod_ddetalle;
                      $modelsDetalles->cant_ddetalle      = $value->cant_ddetalle;
                      $modelsDetalles->precio_ddetalle    = $value->precio_ddetalle;
                      $modelsDetalles->descu_ddetalle     = $value->descu_ddetalle;
                      $modelsDetalles->impuesto_ddetalle  = $value->impuesto_ddetalle;
                      $modelsDetalles->status_ddetalle    = $value->status_ddetalle;
                      $modelsDetalles->documento_ddetalle = $model->id_doc;
                      $modelsDetalles->plista_ddetalle    = $value->plista_ddetalle;
                      $modelsDetalles->total_ddetalle     = $value->total_ddetalle;

                      if ( !($flag = $modelsDetalles->save()) ) {
                          $transaction->rollBack();
                          throw new \Exception("Error Processing Request", 1);
                          break;
                      }

                      if ( $post['NotaCredito']['tipom_doc'] == $model::REPONER_STOCK ) {
                        $modelNotaEntradaDetalle = new NotaEntradaDetalle();
                        $modelNotaEntradaDetalle->trans_detalle = $modelNotaEntrada->id_trans;
                        $modelNotaEntradaDetalle->prod_detalle = $value->prod_detalle;
                        $modelNotaEntradaDetalle->cant_detalle = $value->cant_detalle;

                        if ( !($flag = $modelNotaEntradaDetalle->save()) ) {
                            $transaction->rollBack();
                            throw new \Exception("Error Processing Request", 1);
                            break;
                        }

                        $producto = Producto::findOne(['id_prod' => $value->prod_detalle]);
                        $producto->stock_prod += $value->cant_detalle;

                        if (! ($flag = $producto->save(false))) {
                            $transaction->rollBack();
                            throw new \Exception("Error Processing Request", 1);
                            break;
                        }
                      }
                    }
                  }
                }

                $numeracion = Numeracion::findOne($num[0]['id_num']);
                $numeracion->numero_num = $codigo;
                $flag = $numeracion->save() && $flag;

                $numeracion = Numeracion::findOne($id_num);
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


          } catch ( Exception $e) {
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                $return = [
                  'success' => false,
                  'title' => Yii::t('documento', 'Document'),
                  'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                  'type' => 'error'
                ];
                return $return;
          }
        //
        //
        //
          return;
        }

        return $this->render('create', [
            'model' => $model,
            'IMPUESTO' =>  SiteController::getImpuesto(),
        ]);
    }

    public function actionGetDocumento()
    {

        $request = Yii::$app->request->queryParams;
        if (Yii::$app->request->isAjax) {
          Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          $sucursal = SiteController::getSucursal();
          $model = NotaCredito::find()
                              ->joinWith(['pedidoDoc p'])
                              ->joinWith(['numeracion'])
                              ->where([
                                'cod_doc' => $request['numero'],
                                'numeracion_doc' => $request['tipo'],
                                'sucursal_doc' => $sucursal,
                              ])->one();

          if ( empty($model) ) {
            return false;
          }

          $documento = [
            'id_doc'         => $model->id_doc,
            'id_clte'        => $model->pedidoDoc->cltePedido->id_clte,
            'nombre_cliente' => $model->pedidoDoc->cltePedido->nombre_clte,
            'ruc_cliente'    => $model->pedidoDoc->cltePedido->ruc_clte,
            'dni_cliente'    => $model->pedidoDoc->cltePedido->dni_clte,
            'direcc_cliente' => $model->pedidoDoc->cltePedido->direcc_clte,
            'id_pedido'      => $model->pedidoDoc->id_pedido,
            'cod_doc'        => $model->cod_doc,
            'serie_doc'      => $model->numeracion->serie_num,
            'tipo_doc'       => $model->numeracion->tipoDocumento->abrv_tipod,
            'fecha_doc'      => $model->fecha_doc,
            'id_moneda'      => $model->pedidoDoc->moneda_pedido,
            'moneda_pedido'  => $model->pedidoDoc->monedaPedido->des_moneda,
          ];

          foreach ($model->pedidoDoc->detalles as $key => $value) {
            // code...
            $documento['detalle_pedido'][$key] = [
              'id_pdetalle'       => $value->id_pdetalle,
              'pedido_pdetalle'   => $value->pedido_pdetalle,
              'prod_pdetalle'     => $value->prod_pdetalle,
              'codprod_pdetalle'  => $value->productoPdetalle->cod_prod,
              'desc_pdetalle'     => $value->productoPdetalle->des_prod,
              'umed_pdetalle'     => $value->productoPdetalle->umedProd->des_und,
              'cant_pdetalle'     => $value->cant_pdetalle,
              'precio_pdetalle'   => $value->precio_pdetalle,
              'descu_pdetalle'    => $value->descu_pdetalle,
              'impuesto_pdetalle' => $value->impuesto_pdetalle,
              'plista_pdetalle'   => $value->plista_pdetalle,
              'total_pdetalle'    => $value->total_pdetalle,
            ];
          }

          return $documento;
        }
    }
}
