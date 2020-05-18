<?php

namespace app\controllers;

use Yii;
use app\models\TipoIdentificacion;
use app\models\TipoIdentificionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
/**
 * TipoIdentificacionController implements the CRUD actions for TipoIdentificacion model.
 */
class TipoIdentificacionController extends Controller
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
     * Lists all TipoIdentificacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoIdentificionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoIdentificacion model.
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
     * Creates a new TipoIdentificacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoIdentificacion();
        $this->layout = 'justStuff';



        if ($model->load(Yii::$app->request->post())) {

          $valid = $model->validate();

          // ajax validation
          if (!$valid)
          {
              if (Yii::$app->request->isAjax) {
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  return ActiveForm::validate($model);

              }
          }
          else
          {
              $model->sucursal_tipoi = SiteController::getSucursal();
              $transaction = \Yii::$app->db->beginTransaction();

              try {
                      $model->save();
                      $transaction->commit();
                      //return $this->redirect(['view', 'id' => $model->id_empresa]);
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('tipo_identificacion', 'Document type'),
                        'message' => Yii::t('app','Record has been saved successfully!'),
                        'type' => 'success'
                      ];
                      return $return;

              } catch (Exception $e) {
                  $transaction->rollBack();
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  $return = [
                    'success' => false,
                    'title' => Yii::t('tipo_identificacion', 'Document type'),
                    'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                    'type' => 'error'

                  ];
                  return $return;
              }
          }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TipoIdentificacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

                $this->layout = "justStuff";

                if ($model->load(Yii::$app->request->post())) {

                    $valid = $model->validate();

                    // ajax validation
                    if (!$valid)
                    {
                        if (Yii::$app->request->isAjax) {
                            Yii::$app->response->format = Response::FORMAT_JSON;
                            return ActiveForm::validate($model);

                        }
                    }
                    else
                    {
                        $model->sucursal_tipoi = SiteController::getSucursal();
                        $transaction = \Yii::$app->db->beginTransaction();

                        try {
                                $model->save();
                                $transaction->commit();
                                Yii::$app->response->format = Response::FORMAT_JSON;
                                $return = [
                                  'success' => true,
                                  'title' => Yii::t('tipo_identificacion', 'Document type'),
                                  'message' => Yii::t('app','Record has been saved successfully!'),
                                  'type' => 'success'
                                ];
                                return $return;
                        } catch (Exception $e) {
                            $transaction->rollBack();
                            Yii::$app->response->format = Response::FORMAT_JSON;
                            $return = [
                              'success' => false,
                              'title' => Yii::t('tipo_identificacion', 'Document type'),
                              'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                              'type' => 'error'

                            ];
                            return $return;
                        }
                    }
                }

                return $this->render('update', [
                    'model' => $model,
                ]);

    }

    /**
     * Deletes an existing TipoIdentificacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax) {
          Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          return  true;
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoIdentificacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoIdentificacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoIdentificacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('tipo_identificacion', 'The requested page does not exist.'));
    }
}
