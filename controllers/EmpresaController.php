<?php

namespace app\controllers;

use Yii;
use app\models\Empresa;
use app\models\EmpresaSearch;
use app\models\Sucursal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\base\Model;

/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends Controller
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
     * Lists all Empresa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpresaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empresa model.
     * @param string $id
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
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empresa();

        if ( Yii::$app->request->get( 'asDialog' ) )
        {
          $modelsSucursal = [new Sucursal];
          $this->layout = "justStuff";

          if ($model->load(Yii::$app->request->post())) {

              $modelsSucursal = Model::createMultiple(Sucursal::classname());
              Model::loadMultiple($modelsSucursal, Yii::$app->request->post());

              // ajax validation
              if (Yii::$app->request->isAjax) {
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  return ArrayHelper::merge(
                      ActiveForm::validateMultiple($modelsSucursal),
                      ActiveForm::validate($model)
                  );
              }

              // validate all models
              $valid = $model->validate();
              $valid = Model::validateMultiple($modelsSucursal) && $valid;

              if ($valid) {
                  $transaction = \Yii::$app->db->beginTransaction();
                  try {
                      if ($flag = $model->save(false)) {
                          foreach ($modelsSucursal as $modelSucursal) {
                              $modelSucursal->empresa_suc = $model->id_empresa;
                              if (! ($flag = $modelSucursal->save(false))) {
                                  $transaction->rollBack();
                                  break;
                              }
                          }
                      }
                      if ($flag) {
                          $transaction->commit();
                          //return $this->redirect(['view', 'id' => $model->id_empresa]);
                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = ['success' => true];
                          return $return;
                      }
                  } catch (Exception $e) {
                      $transaction->rollBack();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = ['success' => true];

                      return $return;
                  }
              }
          }

          return $this->render('_frameForm', [
              'model' => $model,
              'modelsSucursal' => (empty($modelsSucursal)) ? [new Sucursal] : $modelsSucursal
          ]);
        }
        else
        {
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['view', 'id' => $model->dni_empresa]);
          }

          return $this->render('create', [
              'model' => $model,
          ]);
        }


    }

    /**
     * Updates an existing Empresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->dni_empresa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Empresa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empresa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('empresa', 'The requested page does not exist.'));
    }
}
