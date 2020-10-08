<?php

namespace app\controllers;

use Yii;
use app\models\ListaPrecios;
use app\models\ListaPreciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ListaPreciosController implements the CRUD actions for ListaPrecios model.
 */
class ListaPreciosController extends Controller
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
     * Lists all ListaPrecios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ListaPreciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('lista', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ListaPrecios model.
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
     * Creates a new ListaPrecios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ListaPrecios();
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
                $model->sucursal_lista = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                        $model->save();
                        $transaction->commit();
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('tipo_listap', 'List price type'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;

                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('tipo_listap', 'List price type'),
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
                return $this->redirect(['view', 'id' => $model->id_prov]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ListaPrecios model.
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
                  $model->sucursal_lista = SiteController::getSucursal();
                  $transaction = \Yii::$app->db->beginTransaction();

                  try {
                          $model->save();
                          $transaction->commit();
                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = [
                            'success' => true,
                            'title' => Yii::t('tipo_listap', 'List price type'),
                            'message' => Yii::t('app','Record has been saved successfully!'),
                            'type' => 'success'
                          ];
                          return $return;
                  } catch (Exception $e) {
                      $transaction->rollBack();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => false,
                        'title' => Yii::t('tipo_listap', 'List price type'),
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
              return $this->redirect(['view', 'id' => $model->id_prov]);
          }

          return $this->render('update', [
              'model' => $model,
          ]);
        }
    }

    public function actionUpdateListaPrecios() //da error porque asi es cuando son GET
    {
        $post = Yii::$app->request->post();
        $band = true;

        $transaction = \Yii::$app->db->beginTransaction();
        
        try {
            foreach($post['dataPreciosAct'] as $key => $value) {
                $model = $this->findModel($value['idLista']);
                $model->precio_lista=$value['precioActual'];
                $band = $model->save() && $band;                
            }

            if ( $band ) {
                
                $transaction->commit();
                //return $this->redirect(['view', 'id' => $model->id_empresa]);
                Yii::$app->response->format = Response::FORMAT_JSON;
                $return = [
                    'success' => true,
                    'title' => Yii::t('app', 'List price'),
                    'message' => Yii::t('app','Record saved successfully!'),
                    'type' => 'success',
                    //'codigo' => $codigo,
                ];
                return $return;
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->response->format = Response::FORMAT_JSON;
            $return = [
                'success' => false,
                'title' => Yii::t('app', 'List price'),
                'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                'type' => 'error'

            ];
            return $return;
        }

    }

    /**
     * Deletes an existing ListaPrecios model.
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
     * Finds the ListaPrecios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ListaPrecios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ListaPrecios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lista_precios', 'The requested page does not exist.'));
    }
}
