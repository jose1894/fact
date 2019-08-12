<?php

namespace app\controllers;

use Yii;
use app\models\Almacen;
use app\models\NotaIngreso;
use app\models\Producto;
use app\models\NotaIngresoDetalle;
use app\models\NotaIngresoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use kartik\widgets\ActiveForm;
use app\components\AutoIncrement;
use app\base\Model;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
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

          // validate all models
          $model->sucursal_trans = SiteController::getSucursal();
          $model->usuario_trans = Yii::$app->user->id;
          $model->codigo_trans = AutoIncrement::getAutoIncrementPad( 'id_trans', 'transaccion', 'grupo_trans', 'E' );
          $model->grupo_trans = 'E';
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
