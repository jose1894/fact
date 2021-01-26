<?php

namespace app\controllers;

use Yii;
use app\models\Provincia;
use app\models\ProvinciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;


/**
 * ProvinciaController implements the CRUD actions for Provincia model.
 */
class ProvinciaController extends Controller
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
     * Lists all Provincia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProvinciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Provincia model.
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
     * Creates a new Provincia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Provincia();

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
              $model->sucursal_prov = SiteController::getSucursal();
              $transaction = \Yii::$app->db->beginTransaction();

              try {
                      $model->save();
                      $transaction->commit();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('provincia', 'Municipality / Province'),
                        'message' => Yii::t('app','Record has been saved successfully!'),
                        'type' => 'success'
                      ];
                      return $return;

              } catch (Exception $e) {
                  $transaction->rollBack();
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  $return = [
                    'success' => false,
                    'title' => Yii::t('provincia', 'Municipality / Province'),
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
     * Updates an existing Provincia model.
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
                $model->sucursal_prov = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                        $model->save();
                        $transaction->commit();
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('provincia', 'Estate / Province'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('provincia', 'Estate / Province'),
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
     * Deletes an existing Provincia model.
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
     * Finds the Provincia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Provincia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Provincia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('provincia', 'The requested page does not exist.'));
    }

    public function actionProvincias() {
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $out = [];
      $parents = Yii::$app->request->post();

      if (isset($parents['depdrop_parents'])) {
          $parents = $parents['depdrop_parents'];
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

              $out = self::getProvincias($cat_id);

              $selected = self::getSelectedProv($cat_id,$param1);
              // the getDefaultSubCat function will query the database
              // and return the default sub cat for the cat_id

              return ['output' => $out, 'selected' => $selected];
          }
      }
      return ['output' => '', 'selected' => ''];
   }

    public static function getProvincias($cat_id) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        $list = Provincia::find()->andWhere(['depto_prov' => $cat_id])->asArray()->all();

        if (count($list) > 0) {
            foreach ($list as $i => $provincias) {
                $out[] = ['id' => $provincias['id_prov'], 'name' => $provincias['des_prov']];
            }
            return $out ;
        }

        return [];
    }

    public static function getSelectedProv($cat_id,$param1) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        $list = Provincia::find()->andWhere(['depto_prov' => $cat_id, 'id_prov' => $param1])->asArray()->all();

        if (count($list) > 0) {
            foreach ($list as $i => $provincias) {
                $selected[] = ['id' => $provincias['id_prov'], 'name' => $provincias['des_prov']];
            }
            return $selected ;
        }

        return [];
    }
}
