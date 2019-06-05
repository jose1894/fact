<?php

namespace app\controllers;

use Yii;
use app\models\Vendedor;
use app\models\VendedorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

/**
 * VendedorController implements the CRUD actions for Vendedor model.
 */
class VendedorController extends Controller
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
     * Lists all Vendedor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendedorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vendedor model.
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
     * Creates a new Vendedor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vendedor();
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
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                        $model->save();
                        $transaction->commit();
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('vendedor', 'Seller'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;

                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('vendedor', 'Seller'),
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
                return $this->redirect(['view', 'id' => $model->id_vendedor]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vendedor model.
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
                  $transaction = \Yii::$app->db->beginTransaction();
                  try {
                          $model->save();
                          $transaction->commit();
                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = [
                            'success' => true,
                            'title' => Yii::t('vendedor', 'Seller'),
                            'message' => Yii::t('app','Record has been saved successfully!'),
                            'type' => 'success'
                          ];
                          return $return;
                  } catch (Exception $e) {
                      $transaction->rollBack();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => false,
                        'title' => Yii::t('vendedor', 'Seller'),
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
              return $this->redirect(['view', 'id' => $model->id_vendedor]);
          }

          return $this->render('update', [
              'model' => $model,
          ]);
        }
    }

    /**
     * Deletes an existing Vendedor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
                 $this->findModel($id)->delete();
                 $transaction->commit();

         } catch (Exception $e) {
             $transaction->rollBack();
             Yii::$app->response->format = Response::FORMAT_JSON;
             $return = [
               'success' => false,
               'title' => Yii::t('vendedor', 'Seller'),
               'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
               'type' => 'error'

             ];
             echo $return;
         }

         if (Yii::$app->request->isAjax) {
              Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
              return  true;
          }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vendedor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vendedor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendedor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('vendedor', 'The requested page does not exist.'));
    }
}
