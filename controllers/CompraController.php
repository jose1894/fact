<?php

namespace app\controllers;

use Yii;
use app\models\Compra;
use app\models\Moneda;
use app\models\CompraDetalle;
use app\models\CompraDetalleSearch;
use app\models\CompraSearch;
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
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
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
     * Lists all Compra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->setSort([
            'defaultOrder' => [
                'cod_compra' => SORT_DESC,
                'fecha_compra' => SORT_DESC
            ]
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compra model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'justStuff';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Compra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $model = new Compra();
      $modelsDetalles = [new CompraDetalle()];

      if ($model->load(Yii::$app->request->post())) {

        $modelsDetalles = Model::createMultiple(CompraDetalle::classname());
        Model::loadMultiple($modelsDetalles, Yii::$app->request->post());

        $num = Numeracion::getNumeracion( Compra::ORDEN_COMPRA );
        $codigo = intval( $num[0]['numero_num'] ) + 1;
        $codigo = str_pad($codigo,10,'0',STR_PAD_LEFT);
        $model->cod_compra = $codigo;

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
            $fecha = explode("/",$model->fecha_compra);
            $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
            $model->fecha_compra = $fecha;
            $model->sucursal_compra = SiteController::getSucursal();
            $model->usuario_compra = Yii::$app->user->id;
            $transaction = \Yii::$app->db->beginTransaction();

            try {

                      if ($flag = $model->save(false)) {
                        foreach ($modelsDetalles as $modelDetalle) {
                            $modelDetalle->compra_cdetalle = $model->id_compra;
                            if (! ($flag = $modelDetalle->save(false))) {
                                $transaction->rollBack();
                                throw new \Exception("Error Processing Request", 1);
                                break;
                            }
                        }
                    }
                    //return $this->redirect(['view', 'id' => $model->id_empresa]);
                    if ($flag) {
                      $numeracion = Numeracion::findOne($num[0]['id_num']);
                      $numeracion->numero_num = $codigo;
                      $numeracion->save();
                      $transaction->commit();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('compra', 'Purchase order'),
                        'id' => $model->id_compra,
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
                  'title' => Yii::t('compra', 'Order'),
                  'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                  'type' => 'error'
                ];
                return $return;
            }
        }
      }

        //$searchModel = new CompraDetalleSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      //  $dataProvider->query->andWhere('compra_cdetalle=:compra', [':compra' => $model->id_compra]);

        $model->moneda_compra = Moneda::findOne(['status_moneda' => 1, 'tipo_moneda' => 'N']);
        //$model->almacen_compra = Almacen::findOne(['status_almacen' => 1]);
        //$model->tipo_compra = 0;
        $model->usuario_compra = Yii::$app->user->id;
        return $this->render('create', [
            'model' => $model,
            'modelsDetalles' => (empty($modelsDetalles)) ? [new CompraDetalle] : $modelsDetalles,
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
     * Updates an existing Compra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);
      $modelsDetalles = $model->detalles;

      if ( $model->estatus_compra == 2) {
          throw new NotFoundHttpException(Yii::t('compra', 'The requested page does not exist.'));
      }

      if ($model->load(Yii::$app->request->post())) {

          $oldIDs = ArrayHelper::map($modelsDetalles, 'id_cdetalle', 'id_cdetalle');
          $modelsDetalles = Model::createMultiple(compraDetalle::classname(), $modelsDetalles, 'id_cdetalle');
          Model::loadMultiple($modelsDetalles, Yii::$app->request->post());
          $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDetalles, 'id_cdetalle', 'id_cdetalle')));

          // validate all models
          $valid = $model->validate();
          $valid = Model::validateMultiple($modelsDetalles) && $valid;


          if ($valid) {
              $transaction = \Yii::$app->db->beginTransaction();

              $fecha = explode("/",$model->fecha_compra);
              $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
              $model->fecha_compra = $fecha;
              $model->sucursal_compra = SiteController::getSucursal();

              try {
                  if ($flag = $model->save(false)) {
                      if (!empty($deletedIDs)) {
                          CompraDetalle::deleteAll(['id_cdetalle' => $deletedIDs]);
                      }
                      foreach ($modelsDetalles as $modelDetalle) {
                          $modelDetalle->compra_cdetalle = $model->id_compra;
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
                        'title' => Yii::t('compra', 'Purchase order'),
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
                    'title' => Yii::t('empresa', 'Company'),
                    'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                    'type' => 'error'

                  ];
                  return $return;
              }
          }
      }

      return $this->render('update', [
          'model' => $model,
          'modelsDetalles' => (empty($modelsDetalles)) ? [new CompraDetalle] : $modelsDetalles,
          'IMPUESTO' => SiteController::getImpuesto(),
      ]);
    }

    /**
     * Deletes an existing Compra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ( $model->estatus_compra == 2) {
                return 0;
            }
            $model->delete();
            return 1;
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Compra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('compra', 'The requested page does not exist.'));
    }

    public function actionCompraRpt( $id ) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      $modelCompra = Compra::findOne($id);
      $this->layout = 'reports';

      $content = $this->render('compraRpt', [
          'compra' => $modelCompra,
      ]);


      $pdf = Yii::$app->pdf; // or new Pdf();
      //$pdf->cssFile = "@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css";
      $pdf->marginTop = 60;
      $mpdf = $pdf->api; // fetches mpdf api


      $f = Yii::$app->formatter;
      $date = $f->asDate($modelCompra->fecha_compra, 'php:j/m/Y');

      $empresa = SiteController::getEmpresa();

      $header = '
      <table>
          <tr>
              <td width="33%" class="center"><b>'.$empresa->nombre_empresa.'</b><br><b> RUC: '.$empresa->ruc_empresa.'</td>
              <td width="33%" class="center"></td>
              <td width="33%" style="font-size:0.75rem" class="right">
                ' . Yii::t('app','Date') . ': {DATE d/m/Y}
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
          <td class="center bold" > ' . Yii::t('compra', 'Purchase order') . ': ' . $modelCompra->cod_compra . ' </td>
        </tr>
      </table>
      <br>
      <table class="datos-cliente" style="font-size:0.75rem">
        <tr>
          <td class="left celdas"><span class="bold">' . Yii::t( 'proveedor', 'Supplier') . ' :</span> ' . $modelCompra->proveeCompra->nombre_prove . '</td>
          <td>&nbsp;</td>
          <td class="right celdas"><span class="bold">' . Yii::t('app','Date') . ' :</span> ' . $date  . '</td>
        </tr>
        <tr>
          <td class="left celdas"><span class="bold">' . Yii::t('condicionp','Payment condition') . ':</span> ' . $modelCompra->condpCompra->desc_condp . ' </td>
          <td>&nbsp;</td>
          <td class="right celdas"><span class="bold">' . Yii::t('moneda','Currency') . ' :</span> ' . $modelCompra->monedaCompra->des_moneda  . '</td>
        </tr>
      </table>
      ';
      $total = 0;
      $subt = 0;
      $subtotal = 0;
      $descuento = 0;
      $totalImp = 0;
      $impuesto = SiteController::getImpuesto() / 100;

      foreach ( $modelCompra->detalles as $value ) {
        $total += $value->total_cdetalle;

        if ( $value->descu_cdetalle && $modelCompra->excento_compra ){
          $desc = ( ( $value->plista_cdetalle  *  $value->descu_cdetalle ) / 100 ) * $value->cant_cdetalle / ( ( $value->impuestouni_cdetalle / 100 ) + 1)  ;
          $descuento += $desc;
        } else if ( $value->descu_cdetalle && !$modelCompra->excento_compra){
          $desc = ( ( $value->plista_cdetalle  *  $value->descu_cdetalle ) / 100 ) * $value->cant_cdetalle  ;
          $descuento += $desc;
        }

        if ( $modelCompra->excento_compra ){
            $subt = ( $value->precio_cdetalle * $value->cant_cdetalle  ) ;
        } else {
            $subt = ( $value->precio_cdetalle * $value->cant_cdetalle  ) / ( ( $value->impuestouni_cdetalle / 100 ) + 1) ;
        }

        $subtotal += $subt;
      }


      $descuento =  $descuento > 0  ? $descuento : 0;
      $subtotal2 = $subtotal - $descuento;

      if ( $modelCompra->excento_compra ){
        $totalImp = 0;
      }else{
        $totalImp = $subtotal2 * $impuesto;
      }


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
          ' . Yii::t('compra', 'Discount') . '
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
          ' . Yii::t('compra','Tax'). ' ' . SiteController::getImpuesto() .'%
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

      $titulo = $modelCompra->cod_compra. '-'.$modelCompra->proveeCompra->nombre_prove.'.pdf';

      $mpdf->SetTitle($titulo);
      $mpdf->Output($titulo, 'I'); // call the mpdf api output as needed
    }

    public function actionAjaxCompras()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = Compra::getCompras();
            return $out;
        }

    }

}
