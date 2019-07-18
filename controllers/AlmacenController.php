<?php

namespace app\controllers;

use Yii;
use app\models\Almacen;
use app\models\AlmacenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

/**
 * AlmacenController implements the CRUD actions for Almacen model.
 */
class AlmacenController extends Controller
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
     * Lists all Almacen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlmacenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Almacen model.
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
     * Creates a new Almacen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Almacen();
        if (Yii::$app->request->get('asDialog'))
        {
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
                $user = User::findOne(Yii::$app->user->id);
                $sucursal = $user->sucursal0->id_suc;

                $model->sucursal_almacen = $sucursal;

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                        $model->save();
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id_empresa]);
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('almacen', 'Warehouse'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;

                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('almacen', 'Warehouse'),
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
        else
        {
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['view', 'id' => $model->id_tpdcto]);
          }

          return $this->render('create', [
              'model' => $model,
          ]);
        }
    }

    /**
     * Updates an existing Almacen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

                if ( Yii::$app->request->get( 'asDialog' ) )
                {
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
                          $user = User::findOne(Yii::$app->user->id);
                          $sucursal = $user->sucursal0->id_suc;

                          $model->sucursal_almacen = $sucursal;
                          $transaction = \Yii::$app->db->beginTransaction();
                          try {
                                  $model->save();
                                  $transaction->commit();
                                  Yii::$app->response->format = Response::FORMAT_JSON;
                                  $return = [
                                    'success' => true,
                                    'title' => Yii::t('almacen', 'Warehouse'),
                                    'message' => Yii::t('app','Record has been saved successfully!'),
                                    'type' => 'success'
                                  ];
                                  return $return;
                          } catch (Exception $e) {
                              $transaction->rollBack();
                              Yii::$app->response->format = Response::FORMAT_JSON;
                              $return = [
                                'success' => false,
                                'title' => Yii::t('almacen', 'Warehouse'),
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
                else
                {
                  if ($model->load(Yii::$app->request->post()) && $model->save()) {
                      return $this->redirect(['view', 'id' => $model->dni_empresa]);
                  }

                  return $this->render('update', [
                      'model' => $model,
                  ]);
                }
    }

    /**
     * Deletes an existing Almacen model.
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
     * Finds the Almacen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Almacen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Almacen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('almacen', 'The requested page does not exist.'));
    }
}
