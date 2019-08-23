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
        $codigo = intval( $num['numero_num'] ) + 1;
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
                      $numeracion = Numeracion::findOne($num['id_num']);
                      $numeracion->numero_num = $codigo;
                      $numeracion->save();                      
                      $transaction->commit();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('compra', 'Order'),
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

        //$searchModel = new PedidoDetalleSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      //  $dataProvider->query->andWhere('pedido_pdetalle=:pedido', [':pedido' => $model->id_pedido]);

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
                          $modelDetalle->compra_pdetalle = $model->id_compra;
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
                        'title' => Yii::t('compra', 'Order'),
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
        $this->findModel($id)->delete();

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
}
