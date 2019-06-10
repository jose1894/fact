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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        if (Yii::$app->request->get('asDialog'))
        {
          $this->layout = 'justStuff';
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
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
      //  if (Yii::$app->request->get('asDialog'))
        //{
          //$this->layout = 'justStuff';
          $modelsDetalles = [new PedidoDetalle()];

          if ($model->load(Yii::$app->request->post())) {

            $modelsDetalles = Model::createMultiple(PedidoDetalle::classname());
            Model::loadMultiple($modelsDetalles, Yii::$app->request->post());

            // validate all models
            $model->cod_pedido = AutoIncrement::getAutoIncrementPad( 'pedido' );
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
                $fecha = explode("/",$model->fecha_pedido);
                $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                $model->fecha_pedido = $fecha;
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
                          $transaction->commit();
                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = [
                            'success' => true,
                            'title' => Yii::t('pedido', 'Order'),
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
          return $this->render('create', [
              'model' => $model,
              'modelsDetalles' => (empty($modelsDetalles)) ? [new PedidoDetalle] : $modelsDetalles,
              //'searchModel' => $searchModel,
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

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsDetalles, 'id_pedido', 'pedido_pdetalle');
            $modelsDetalles = Model::createMultiple(PedidoDetalle::classname(), $modelsDetalles);
            Model::loadMultiple($modelsDetalle, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDetalles, 'id_pedido', 'pedido_pdetalle')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDetalles) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            PedidoDetalle::deleteAll(['pedido_pdetalle' => $deletedIDs]);
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
                          'heading' => true,
                          'id' => $model->id_pedido
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
            'modelsDetalles' => (empty($modelsDetalles)) ? [new PedidoDetalle] : $modelsDetalles
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


}
