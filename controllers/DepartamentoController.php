<?php

namespace app\controllers;

use Yii;
use app\models\Departamento;
use app\models\DepartamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

/**
 * DepartamentoController implements the CRUD actions for Departamento model.
 */
class DepartamentoController extends Controller
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
     * Lists all Departamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departamento model.
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
     * Creates a new Departamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Departamento();
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
                          'title' => Yii::t('departamento', 'Department / County / Municipality'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;

                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('departamento', 'Department / County / Municipality'),
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
                return $this->redirect(['view', 'id' => $model->id_depto]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Departamento model.
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
                            'title' => Yii::t('departamento', 'Department / County / Municipality'),
                            'message' => Yii::t('app','Record has been saved successfully!'),
                            'type' => 'success'
                          ];
                          return $return;
                  } catch (Exception $e) {
                      $transaction->rollBack();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => false,
                        'title' => Yii::t('departamento', 'Department / County / Municipality'),
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
              return $this->redirect(['view', 'id' => $model->id_depto]);
          }

          return $this->render('update', [
              'model' => $model,
          ]);
        }
    }

    /**
     * Deletes an existing Departamento model.
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
     * Finds the Departamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Departamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Departamento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('departamento', 'The requested page does not exist.'));
    }

    public function actionDepartamentos() {
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
          if ($parents != null) {
              $cat_id = $parents[0];
              $param1 = null;
              $param2 = null;
              //var_dump( $_POST['depdrop_params'] );
              //exit();
              if (!empty($_POST['depdrop_params'])) {
                  $params = $_POST['depdrop_params'];
                  $param1 = $params[0]; // get the value of input-type-1
                  //$param2 = $params[1]; // get the value of input-type-2
              }

              $out = self::getDepartamentos($cat_id);

              $selected = self::getSelectedDeptos($cat_id,$param1);
              // the getDefaultSubCat function will query the database
              // and return the default sub cat for the cat_id

              return ['output' => $out, 'selected' => $selected];
          }
      }
      return ['output' => '', 'selected' => ''];
   }

    public static function getDepartamentos($cat_id) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        $list = Departamento::find()->andWhere(['prov_depto' => $cat_id])->asArray()->all();
      //  echo $list->createCommand()->getRawSql();
        if (count($list) > 0) {
            foreach ($list as $i => $departamentos) {
                $out[] = ['id' => $departamentos['id_depto'], 'name' => $departamentos['des_depto']];
            }
            return $out ;
        }

        return [];
    }

    public static function getSelectedDeptos($cat_id,$param1) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $selected = [];
        $list = Departamento::find()->andWhere(['prov_depto' => $cat_id,'id_depto' => $param1 ])->asArray()->all();
        $selected['params'] = ['prov_depto' => $cat_id,'id_depto' => $param1 ];
        if (count($list) > 0) {
            foreach ($list as $i => $departamentos) {
                $selected[] = ['id' => $departamentos['id_depto'], 'name' => $departamentos['des_depto']];
            }
            return $selected ;
        }

        return [];
    }
}
