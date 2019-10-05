<?php

namespace app\controllers;

use Yii;
use app\models\Pedido;
use app\models\Moneda;
use app\models\Almacen;
use app\models\PedidoDetalle;
use app\models\PedidoDetalleSearch;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use kartik\widgets\ActiveForm;
use app\components\AutoIncrement;
use app\base\Model;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
use app\models\Numeracion;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
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
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $request = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($request);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $this->layout = 'justStuff';
        $model = $this->findModel($id);

        $tipo = ($model->tipo_pedido === Pedido::PEDIDO) ? 'PEDIDO' : ($model->tipo_pedido === Pedido::PROFORMA) ? 'PROFORMA' : 'COTIZACION';
        return $this->render('view', [
            'model' => $this->findModel($id),
            'tipo' => $tipo
        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pedido();
          $modelsDetalles = [new PedidoDetalle()];

          if ($model->load(Yii::$app->request->post())) {

            $modelsDetalles = Model::createMultiple(PedidoDetalle::classname());
            Model::loadMultiple($modelsDetalles, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDetalles) && $valid;
            // ajax validation
            if (!$valid)
            {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsDetalles),
                        ActiveForm::validate($model)
                    );
                }
            }
            else
            {
                $num = Numeracion::getNumeracion( $model->tipo_pedido );
                $codigo = intval( $num['numero_num'] ) + 1;
                $codigo = str_pad($codigo,10,'0',STR_PAD_LEFT);
                $model->cod_pedido = $codigo;

                $fecha = explode("/",$model->fecha_pedido);
                $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                $model->fecha_pedido = $fecha;
                $model->sucursal_pedido = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();

                try {

                          if ($flag = $model->save(false)) {
                            foreach ($modelsDetalles as $modelDetalle) {
                                $modelDetalle->pedido_pdetalle = $model->id_pedido;
                                if (! ($flag = $modelDetalle->save(false))) {
                                    $transaction->rollBack();
                                    throw new \Exception("Error Processing Request", 1);
                                    break;
                                }
                            }
                        }
                        //return $this->redirect(['view', 'id' => $model->id_empresa]);
                        if ($flag) {
                          $numeracion = Numeracion::findOne($num['id_num']);
                          $numeracion->numero_num = $codigo;
                          $numeracion->save();
                          $transaction->commit();

                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = [
                            'success' => true,
                            'title' => Yii::t('pedido', 'Order'),
                            'id' => $model->id_pedido,
                            'message' => Yii::t('app','Record saved successfully!'),
                            'type' => 'success'
                          ];
                          return $return;
                        }

                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('pedido', 'Order'),
                      'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                      'type' => 'error'
                    ];
                    return $return;
                }
            }
          }

          //$searchModel = new PedidoDetalleSearch();
          //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //  $dataProvider->query->andWhere('pedido_pdetalle=:pedido', [':pedido' => $model->id_pedido]);

          $model->moneda_pedido = Moneda::findOne(['status_moneda' => 1, 'tipo_moneda' => 'N']);
          $model->almacen_pedido = Almacen::findOne(['status_almacen' => 1]);
          $model->tipo_pedido = 0;
          $model->usuario_pedido = Yii::$app->user->id;
          return $this->render('create', [
              'model' => $model,
              'modelsDetalles' => (empty($modelsDetalles)) ? [new PedidoDetalle] : $modelsDetalles,
              'IMPUESTO' => SiteController::getImpuesto(),
              //'dataProvider' => $dataProvider,
          ]);
        /*}
        else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_tpdcto]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsDetalles = $model->detalles;

        $tipoPedido = $model->tipo_pedido;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsDetalles, 'id_pdetalle', 'id_pdetalle');
            $modelsDetalles = Model::createMultiple(PedidoDetalle::classname(), $modelsDetalles, 'id_pdetalle');
            Model::loadMultiple($modelsDetalles, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDetalles, 'id_pdetalle', 'id_pdetalle')));

            //echo '$tipoPedido: '.$tipoPedido;
            //echo '$model->tipo_pedido '.$model->tipo_pedido;


            if ( $tipoPedido !== $model->tipo_pedido){
              $model->cod_pedido = AutoIncrement::getAutoIncrementPad( 'cod_pedido', 'pedido', 'tipo_pedido', $model->tipo_pedido );
              $codigo = $model->cod_pedido;
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDetalles) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                $fecha = explode("/",$model->fecha_pedido);
                $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                $model->fecha_pedido = $fecha;
                $model->sucursal_pedido = SiteController::getSucursal();

                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            PedidoDetalle::deleteAll(['id_pdetalle' => $deletedIDs]);
                        }
                        foreach ($modelsDetalles as $modelDetalle) {
                            $modelDetalle->pedido_pdetalle = $model->id_pedido;
                            if (! ($flag = $modelDetalle->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $model->save();
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id_empresa]);
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('pedido', 'Order'),
                          'message' => Yii::t('app','Record saved successfully!'),
                          'type' => 'success',
                          //'codigo' => $codigo,
                        ];
                        return $return;
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('empresa', 'Company'),
                      'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                      'type' => 'error'

                    ];
                    return $return;
                }
            }
        }

        $tipo = ($model->tipo_pedido === Pedido::PEDIDO) ? 'PEDIDO' : ($model->tipo_pedido === Pedido::PROFORMA) ? 'PROFORMA' : 'COTIZACION';

        return $this->render('update', [
            'model' => $model,
            'modelsDetalles' => (empty($modelsDetalles)) ? [new PedidoDetalle] : $modelsDetalles,
            'IMPUESTO' => SiteController::getImpuesto(),
            'tipo' => $tipo
        ]);

    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return 1;
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('pedido', 'The requested page does not exist.'));
    }

    public function actionPedidoRpt( $id ) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      $modelPedido = Pedido::findOne($id);
      $this->layout = 'reports';
      //$modelDetalle = $modelPedido->detalles;
      $content = $this->render('pedidoRpt', [
          'pedido' => $modelPedido,
      ]);


      $pdf = Yii::$app->pdf; // or new Pdf();
      //$pdf->cssFile = "@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css";
      $pdf->marginTop = 60;
      $mpdf = $pdf->api; // fetches mpdf api

      $proforma = Yii::t('pedido','PROFORMA');
      $cotizacion = Yii::t('pedido','QUOTATION');
      $pedido = Yii::t('pedido','ORDER');

      $tipoPedido  = $modelPedido->tipo_pedido > 0 ?  $modelPedido->tipo_pedido == 1 ? $proforma : $cotizacion : $pedido;

      $f = Yii::$app->formatter;
      $date = $f->asDate($modelPedido->fecha_pedido, 'php:j/m/Y');

      $header = '
      <table>
          <tr>
              <td width="33%" class="center">MARVIG<!-- *-empresa-* --></td>
              <td width="33%" class="center"></td>
              <td width="33%" style="font-size:0.75rem" class="right">
                ' . Yii::t('app','Date') . ': {DATE j/m/Y}
                <br>
                ' . Yii::t('app','Hour') . ': {DATE H:i:s}
                <br>
                ' . Yii::t('app','Page') . ': {PAGENO}/{nbpg}
              </td>
          </tr>
      </table>
      <br>
      <table >
        <tr>
          <td class="center bold" > ' . $tipoPedido . ': ' . $modelPedido->cod_pedido . ' </td>
        </tr>
      </table>
      <br>
      <table class="datos-cliente" style="font-size:0.75rem">
        <tr>
          <td class="left celdas"><span class="bold">' . Yii::t( 'cliente', 'Customer') . ' :</span> ' . $modelPedido->cltePedido->nombre_clte . '</td>
          <td>&nbsp;</td>
          <td class="right celdas"><span class="bold">' . Yii::t('app','Date') . ' :</span> ' . $date  . '</td>
        </tr>
        <tr>
          <td class="left celdas"><span class="bold">' . Yii::t( 'cliente', 'Address') . ' :</span> ' . $modelPedido->cltePedido->direcc_clte . '
          ' . $modelPedido->cltePedido->provClte->des_prov. ' - ' . $modelPedido->cltePedido->deptoClte->des_depto . '
          - ' . $modelPedido->cltePedido->dttoClte->des_dtto . '
          </td>
          <td>&nbsp;</td>
          <td class="right celdas"><span class="bold">' . Yii::t('condicionp','Payment condition') . ':</span> ' . $modelPedido->condpPedido->desc_condp . ' </td>
        </tr>
        <tr>
          <td class="left celdas"><span class="bold">' . Yii::t( 'cliente', 'RUC') . ' :</span> ' . $modelPedido->cltePedido->ruc_clte . '</td>
          <td>&nbsp;</td>
          <td class="right celdas"><span class="bold">' . Yii::t('moneda','Currency') . ' :</span> ' . $modelPedido->monedaPedido->des_moneda  . '</td>
        </tr>
        <tr>
          <td class="left celdas"><span class="bold">' . Yii::t( 'vendedor', 'Seller') . ' :</span> ' . $modelPedido->vendPedido->nombre_vend . '</td>
          <td>&nbsp;</td>
          <td class="right celdas">&nbsp;</td>
        </tr>
      </table>
      ';
      $total = 0;
      $subt = 0;
      $subtotal = 0;
      $descuento = 0;
      $totalImp = 0;
      $impuesto = SiteController::getImpuesto() / 100;

      foreach ( $modelPedido->detalles as $value ) {
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


      $footer = '
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
          ' . Yii::t('pedido','Tax'). ' ' . SiteController::getImpuesto() .'%
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

      $sheet = file_get_contents( Yii::getAlias( '@rptcss' ).'/rptCss.css' );
      $mpdf->WriteHTML( $sheet, 1 );

      $mpdf->SetHTMLHeader( $header ); // call methods or set any properties
      $mpdf->WriteHtml( $content ); // call mpdf write html
      $mpdf->SetHTMLFooter( $footer );
      
      $titulo = $modelPedido->cod_pedido. '-'. $tipoPedido .'-'.$modelPedido->cltePedido->nombre_clte.'.pdf';

      $mpdf->SetTitle($titulo);
      $mpdf->Output($titulo, 'I'); // call the mpdf api output as needed
    }


}
