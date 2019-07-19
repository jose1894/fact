<?php

namespace app\controllers;

use Yii;
use app\models\Zona;
use app\models\ZonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

/**
 * ZonaController implements the CRUD actions for Zona model.
 */
class ZonaController extends Controller
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
     * Lists all Zona models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Zona model.
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
     * Creates a new Zona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zona();

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
                $model->sucursal_zona = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                        $model->save();
                        $transaction->commit();
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('zona', 'Zone'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;

                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('zona', 'Zone'),
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
     * Updates an existing Zona model.
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
                  $model->sucursal_zona = SiteController::getSucursal();
                  $transaction = \Yii::$app->db->beginTransaction();

                  try {
                          $model->save();
                          $transaction->commit();
                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = [
                            'success' => true,
                            'title' => Yii::t('zona', 'Zone'),
                            'message' => Yii::t('app','Record has been saved successfully!'),
                            'type' => 'success'
                          ];
                          return $return;
                  } catch (Exception $e) {
                      $transaction->rollBack();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => false,
                        'title' => Yii::t('zona', 'Zone'),
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
              return $this->redirect(['view', 'id' => $model->id_zona]);
          }

          return $this->render('update', [
              'model' => $model,
          ]);
        }
    }

    /**
     * Deletes an existing Zona model.
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
     * Finds the Zona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Zona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zona::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('zona', 'The requested page does not exist.'));
    }
}
