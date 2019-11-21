<?php

namespace app\controllers;

use Yii;
use app\models\TipoCambio;
use app\models\TipoCambioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use kartik\widgets\ActiveForm;

/**
 * TipoCambioController implements the CRUD actions for TipoCambio model.
 */
class TipoCambioController extends Controller
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
     * Lists all TipoCambio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoCambioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoCambio model.
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
     * Creates a new TipoCambio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoCambio();

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
              $model->sucursal_tipoc = SiteController::getSucursal();
              $transaction = \Yii::$app->db->beginTransaction();

              try {
                      $model->save();
                      $transaction->commit();
                      //return $this->redirect(['view', 'id' => $model->id_empresa]);
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('tipo_cambio', 'Exchange'),
                        'message' => Yii::t('app','Record has been saved successfully!'),
                        'type' => 'success'
                      ];
                      return $return;

              } catch (Exception $e) {
                  $transaction->rollBack();
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  $return = [
                    'success' => false,
                    'title' => Yii::t('tipo_cambio', 'Exchange'),
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
     * Creates a new TipoCambio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDiario()
    {
        $model = new TipoCambio();

        $this->layout = 'justStuff';



        if ($model->load(Yii::$app->request->post())) {

            $model->fecha_tipoc = date('Y-m-d');
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
              $model->sucursal_tipoc = SiteController::getSucursal();
              $transaction = \Yii::$app->db->beginTransaction();

              try {
                      $model->save();
                      $transaction->commit();
                      //return $this->redirect(['view', 'id' => $model->id_empresa]);
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('tipo_cambio', 'Exchange'),
                        'message' => Yii::t('app','Record has been saved successfully!'),
                        'type' => 'success'
                      ];
                      return $return;

              } catch (Exception $e) {
                  $transaction->rollBack();
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  $return = [
                    'success' => false,
                    'title' => Yii::t('tipo_cambio', 'Exchange'),
                    'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                    'type' => 'error'

                  ];
                  return $return;
              }
          }
        }

        return $this->render('diario', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TipoCambio model.
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
                $model->sucursal_tipod = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                        $model->save();
                        $transaction->commit();
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('tipo_cambio', 'Exchange'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('tipo_cambio', 'Exchange'),
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
     * Deletes an existing TipoCambio model.
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
     * Finds the TipoCambio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoCambio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoCambio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('tipo_cambio', 'The requested page does not exist.'));
    }

    public function actionConsultaTipoc()
    {
      $return = [ 'success' => false,
          'last' => [
                'cambioc_tipoc' => 0,
                'venta_tipoc' => 0,
                'valorf_tipoc' => 0
            ]
      ];


      $fecha = Yii::$app->request->post('fecha');
      $model = TipoCambio::find(['fecha_tipoc' => $fecha ])->one();

      if ( !is_null($model) ){
          $model = TipoCambio::find()
              ->orderBy('fecha_tipoc')
              ->one();

          $return = ['success' => true,
                     'last' => [
                         'cambioc_tipoc' => $model->cambioc_tipoc,
                         'venta_tipoc' => $model->venta_tipoc,
                         'valorf_tipoc' => $model->valorf_tipoc
                     ]
          ];
      }

      echo json_encode( $return );
    }
}
