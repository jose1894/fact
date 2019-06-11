<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\ProductoSearch;
use app\models\ListaPrecios;
use app\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use yii\db\Query;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
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
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();
        if ( Yii::$app->request->get( 'asDialog' ) )
        {
          $modelsListaP = [new ListaPrecios()];
          $this->layout = "justStuff";

          if ($model->load(Yii::$app->request->post())) {


              $modelsListaP = Model::createMultiple(ListaPrecios::classname(),[],'id_lista');
              Model::loadMultiple($modelsListaP, Yii::$app->request->post());

              $valid = $model->validate();
              $valid = Model::validateMultiple($modelsListaP) && $valid;

              // ajax validation
              if (!$valid)
              {
                  if (Yii::$app->request->isAjax) {
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      return ArrayHelper::merge(
                          ActiveForm::validateMultiple($modelsListaP),
                          ActiveForm::validate($model)
                      );
                  }
              }
              else
              {
                  $transaction = \Yii::$app->db->beginTransaction();
                  try {
                      if ($flag = $model->save(false)) {
                          foreach ($modelsListaP as $modelListaP) {
                              $modelListaP->prod_lista = $model->id_prod;
                              if (! ($flag = $modelListaP->save(false))) {
                                  $transaction->rollBack();
                                  break;
                              }
                          }
                      }
                      if ($flag) {
                          $transaction->commit();
                          //return $this->redirect(['view', 'id' => $model->id_prod]);
                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = [
                            'success' => true,
                            'title' => Yii::t('producto', 'Product'),
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
                        'title' => Yii::t('producto', 'Product'),
                        'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                        'type' => 'error'

                      ];
                      return $return;
                  }
              }
          }

          return $this->render('create', [
              'model' => $model,
              'modelsListaP' => (empty($modelsListaP)) ? [new ListaPrecios()] : $modelsListaP
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
     * Updates an existing Producto model.
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
          $modelsListaP = $model->listas;
          $this->layout = "justStuff";

          if ($model->load(Yii::$app->request->post())) {

              //exit( "post aki" );
              $oldIDs = ArrayHelper::map($modelsListaP, 'id_lista', 'id_lista');
              $modelsListaP = Model::createMultiple(ListaPrecios::classname(), $modelsListaP,'id_lista');
              Model::loadMultiple($modelsListaP, Yii::$app->request->post());
              $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsListaP, 'id_lista', 'id_lista')));

              $valid = $model->validate();
              $valid = Model::validateMultiple($modelsListaP) && $valid;

              // ajax validation
              if (!$valid)
              {
                  if (Yii::$app->request->isAjax) {
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      return ArrayHelper::merge(
                          ActiveForm::validateMultiple($modelsListaP),
                          ActiveForm::validate($model)
                      );
                  }
              }
              else
              {
                  $transaction = \Yii::$app->db->beginTransaction();
                  try {
                      if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            ListaPrecios::deleteAll(['id_lista' => $deletedIDs]);
                        }

                          foreach ($modelsListaP as $modelListaP) {
                              $modelListaP->prod_lista = $model->id_prod;
                              if (! ($flag = $modelListaP->save(false))) {
                                  $transaction->rollBack();
                                  break;
                              }
                          }
                      }
                      if ($flag) {
                          $transaction->commit();
                          //return $this->redirect(['view', 'id' => $model->id_prod]);
                          Yii::$app->response->format = Response::FORMAT_JSON;
                          $return = [
                            'success' => true,
                            'title' => Yii::t('producto', 'Product'),
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
                        'title' => Yii::t('producto', 'Product'),
                        'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                        'type' => 'error'

                      ];
                      return $return;
                  }
              }
          }

          return $this->render('update', [
              'model' => $model,
              'modelsListaP' => (empty($modelsListaP)) ? [new ListaPrecios] : $modelsListaP
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
     * Deletes an existing Producto model.
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
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('producto', 'The requested page does not exist.'));
    }

    public function actionProductoList($q = null, $id = null,$desc = null,$tipo_listap = null) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($desc))
        {
            $query = new Query;
            $query->select(['p.id_prod as id','p.cod_prod as cod_prod', 'p.des_prod as des_prod', 'p.texto AS text','p.precio_lista as precio'])
                ->from(['v_productos as p'])
                ->where('p.status_prod = 1')
                ->andWhere(['like', 'p.texto', $desc])
                ->andWhere('p.tipo_lista = :tipo_listap',[':tipo_listap' =>  $tipo_listap])
                ->orderBy('p.cod_prod ASC')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
          $query = new Query;
          $query->select(['p.id_prod as id','p.cod_prod as cod_prod', 'p.des_prod as des_prod', 'p.texto AS text','p.precio_lista as precio'])
              ->from(['v_productos as p'])
              ->where('p.status_prod = 1')
              ->andWhere(['p.id_prod = :id',['id' =>  $id]])
              ->limit(20);
          $command = $query->createCommand();
          $data = $command->queryAll();
          $out['results'] = array_values($data);
        }
        return $out;
    }

    public function actionProductPrice( $id )
    {
      \Yii::$app->response->format = Response::FORMAT_JSON;
      $out = ['results' => false];
      if (!is_null($id))
      {
          $tipo_lista = Yii::$app->request->get( 'tipo_listap' );
          $query = new Query;
          $query->select(['p.precio_lista as precio'])
              ->from(['v_productos as p'])
              ->where('p.status_prod = 1')
              ->andWhere('p.id_prod = :id',['id' =>  $id])
              ->andWhere('p.tipo_lista = :tipo_lista',['tipo_lista' =>  $tipo_lista])
              ->limit(1);
          $command = $query->createCommand();
          $data = $command->queryAll();
          $out['results'] = $data;
      }
      return $out;
     }
}
