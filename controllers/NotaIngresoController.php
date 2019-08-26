<?php

namespace app\controllers;

use Yii;
use app\models\Almacen;
use app\models\NotaIngreso;
use app\models\Producto;
use app\models\User;
use app\models\NotaIngresoDetalle;
use app\models\NotaIngresoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use kartik\widgets\ActiveForm;
use app\base\Model;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
use app\models\Numeracion;
/**
 * NotaIngresoController implements the CRUD actions for NotaIngreso model.
 */
class NotaIngresoController extends Controller
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
     * Lists all NotaIngreso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotaIngresoSearch();
        $searchModel->status_trans = NotaIngreso::STATUS_UNAPPROVED;
        $searchModel->ope_trans = NotaIngreso::OPE_TRANS;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NotaIngreso model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->request->get('asDialog'))
        {
          $this->layout = 'justStuff';
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NotaIngreso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NotaIngreso();
        $modelsDetalles = [new NotaIngresoDetalle()];

        if ($model->load(Yii::$app->request->post())) {

          $modelsDetalles = Model::createMultiple(NotaIngresoDetalle::classname());
          Model::loadMultiple($modelsDetalles, Yii::$app->request->post());

          $model->sucursal_trans = SiteController::getSucursal();
          $model->usuario_trans = Yii::$app->user->id;
          $model->ope_trans = $model::OPE_TRANS;
          $num = Numeracion::getNumeracion( $model::NOTA_INGRESO );
          $codigo = intval( $num['numero_num'] ) + 1;
          $codigo = str_pad($codigo,10,'0',STR_PAD_LEFT);
          $model->codigo_trans = $codigo;

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
              $fecha = explode("/",$model->fecha_trans);
              $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
              $model->fecha_trans = $fecha;
              $transaction = \Yii::$app->db->beginTransaction();

              try {

                        if ($flag = $model->save(false)) {
                          foreach ($modelsDetalles as $modelDetalle) {
                              $modelDetalle->trans_detalle = $model->id_trans;
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
                          'title' => Yii::t('ingreso', 'Entry note'),
                          'id' => $model->id_trans,
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
                    'title' => Yii::t('ingreso', 'Entry note'),
                    'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                    'type' => 'error'
                  ];
                  return $return;
              }
          }
        }

        //$searchModel = new NotaIngresoDetalleSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //  $dataProvider->query->andWhere('trans_pdetalle=:trans', [':trans' => $model->id_trans]);

        $model->almacen_trans = Almacen::findOne(['status_almacen' => 1]);
        $model->usuario_trans = Yii::$app->user->id;
        return $this->render('create', [
            'model' => $model,
            'modelsDetalles' => (empty($modelsDetalles)) ? [new NotaIngresoDetalle] : $modelsDetalles,
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
     * Updates an existing NotaIngreso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsDetalles = $model->detalles;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsDetalles, 'id_detalle', 'id_detalle');
            $modelsDetalles = Model::createMultiple(NotaIngresoDetalle::classname(), $modelsDetalles, 'id_detalle');
            Model::loadMultiple($modelsDetalles, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDetalles, 'id_detalle', 'id_detalle')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDetalles) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                $fecha = explode("/",$model->fecha_trans);
                $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                $model->fecha_trans = $fecha;
                $model->sucursal_trans = SiteController::getSucursal();

                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            NotaIngresoDetalle::deleteAll(['id_detalle' => $deletedIDs]);
                        }
                        foreach ($modelsDetalles as $modelDetalle) {
                            $modelDetalle->trans_detalle = $model->id_trans;
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
                          'title' => Yii::t('ingreso', 'Entry note'),
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
                      'title' => Yii::t('ingreso', 'Entry note'),
                      'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                      'type' => 'error'

                    ];
                    return $return;
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsDetalles' => (empty($modelsDetalles)) ? [new NotaIngresoDetalle] : $modelsDetalles,
        ]);
    }

    /**
     * Deletes an existing NotaIngreso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax && $model->status_trans === 0) {
            $model->delete();
            return true;
         }


         return false;


    }

    /**
     * Finds the NotaIngreso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NotaIngreso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NotaIngreso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('tipo_movimiento', 'The requested page does not exist.'));
    }

    public function actionAprobarNota()
    {
      $return = [];
      $nota = Yii::$app->request->post( 'NotaIngreso' );


      if ( $nota['codigo_trans'] ){
        $model = NotaIngreso::findOne(['codigo_trans' => $nota['codigo_trans']]);

        if ( $model->status_trans == 1 )
        {
          Yii::$app->response->format = Response::FORMAT_JSON;
          $return = [
            'success' => false,
            'title' => Yii::t('ingreso', 'Entry note'),
            'message' => Yii::t('ingreso','Entry note already has been approved!'),
            'type' => 'error'
          ];
          return $return;
        }

        $modelsDetalles = $model->detalles;
      }



      if (Yii::$app->request->post()) {
          if ( !empty($model) ) {

              $transaction = \Yii::$app->db->beginTransaction();
              $model->status_trans = NotaIngreso::STATUS_APPROVED;
              try {
                  if ($flag = $model->save(false)) {

                      foreach ($modelsDetalles as $modelDetalle) {
                          $modelDetalle->trans_detalle = $model->id_trans;
                          $producto = Producto::findOne(['id_prod' => $modelDetalle->prod_detalle]);
                          $producto->stock_prod += $modelDetalle->cant_detalle;

                          if (! ($flag = $producto->save(false))) {
                              $transaction->rollBack();
                              break;
                          }
                      }
                  }
                  if ($flag) {
                      $model->status_trans = NotaIngreso::STATUS_APPROVED;
                      $model->save();
                      $transaction->commit();
                      //return $this->redirect(['view', 'id' => $model->id_empresa]);
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('ingreso', 'Entry note'),
                        'message' => Yii::t('ingreso','Entry note has been approved successfully!'),
                        'type' => 'success'
                      ];
                      return $return;
                  }
              } catch (Exception $e) {
                  $transaction->rollBack();
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  $return = [
                    'success' => false,
                    'title' => Yii::t('ingreso', 'Entry note'),
                    'message' => Yii::t('ingreso','Entry note couldn´t be approved!') . " \nError: ". $e->errorMessage(),
                    'type' => 'error'

                  ];
                  return $return;
              }
          }
      }
    }

    public function actionNotaiRpt( $id ) {
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      $modelNotaIngreso = NotaIngreso::findOne($id);
      $this->layout = 'reports';

      $content = $this->render('notaIngresoRpt', [
          'nota' => $modelNotaIngreso,
      ]);


      $pdf = Yii::$app->pdf; // or new Pdf();
      //$pdf->cssFile = "@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css";
      $pdf->marginTop = 60;
      $mpdf = $pdf->api; // fetches mpdf api

      $f = Yii::$app->formatter;
      $date = $f->asDate($modelNotaIngreso->fecha_trans, 'php:j/m/Y');

      $empresa = SiteController::getEmpresa();

      $header = '
      <table style="font-size:1rem">
          <tr>
              <td width="40%" class="center"><b>'.$empresa->nombre_empresa.'</b><br><b> RUC: '.$empresa->ruc_empresa.'</b></td>
              <td width="30%" class="center"></td>
              <td width="30%" style="font-size:0.75rem" class="right">
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
          <td class="center bold" > ' . Yii::t('ingreso','Entry note') . ': ' . $modelNotaIngreso->codigo_trans . ' </td>
        </tr>
      </table>
      <br>
      <table class="datos-cliente" style="font-size:1rem">
        <tr>
          <td class="left celdas"><span class="bold">' . Yii::t( 'almacen', 'Warehouse') . ' :</span> ' . $modelNotaIngreso->almacenTrans->des_almacen . '</td>
          <td class="center celdas"><span class="bold">' . Yii::t('app','Date') . ' :</span> ' . $date  . '</td>
          <td class="right celdas"><span class="bold">' . Yii::t( 'ingreso', 'Movement type') . ' :</span> ' . $modelNotaIngreso->tipoTrans->des_tipom . '</td>
        </tr>
      </table>
      ';


      $footer = '
      <hr>
      ';

      $sheet = file_get_contents( Yii::getAlias( '@rptcss' ).'/rptCss.css' );
      $mpdf->WriteHTML( $sheet, 1 );

      $mpdf->SetHTMLHeader( $header ); // call methods or set any properties
      $mpdf->WriteHtml( $content ); // call mpdf write html
      $mpdf->SetHTMLFooter( $footer );

  //    $tipo = ($modelPedido->tipo_pedido === 1) ? 'PEDIDO' : ($modelPedido->tipo_pedido === 2) ? 'PROFORMA' : 'COTIZACION';
      $titulo = Yii::t('ingreso','Entry note').'-'.$modelNotaIngreso->codigo_trans.'.pdf';

      $mpdf->SetTitle($titulo);
      $mpdf->Output($titulo, 'I'); // call the mpdf api output as needed
    }
}
