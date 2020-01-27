<?php

namespace app\controllers;

use Yii;
use app\models\Distrito;
use app\models\DistritoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

/**
 * DistritoController implements the CRUD actions for Distrito model.
 */
class DistritoController extends Controller
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
     * Lists all Distrito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DistritoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Distrito model.
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
     * Creates a new Distrito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Distrito();
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
              $model->sucursal_dtto = SiteController::getSucursal();
              $transaction = \Yii::$app->db->beginTransaction();
              try {
                      $model->save();
                      $transaction->commit();
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('distrito', 'District / Parish'),
                        'message' => Yii::t('app','Record has been saved successfully!'),
                        'type' => 'success'
                      ];
                      return $return;

              } catch (Exception $e) {
                  $transaction->rollBack();
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  $return = [
                    'success' => false,
                    'title' => Yii::t('distrito', 'District / Parish'),
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
     * Updates an existing Distrito model.
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
                $model->sucursal_dtto = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                        $model->save();
                        $transaction->commit();
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('distrito', 'District / Parish'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('distrito', 'District / Parish'),
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
     * Deletes an existing Distrito model.
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
     * Finds the Distrito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Distrito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Distrito::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('distrito', 'The requested page does not exist.'));
    }

    public function actionDistritos() {
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

              $out = self::getDistritos($cat_id);

              $selected = self::getSelectedDttos($cat_id,$param1);
              // the getDefaultSubCat function will query the database
              // and return the default sub cat for the cat_id

              return ['output' => $out, 'selected' => $selected];
          }
      }
      return ['output' => '', 'selected' => ''];
   }

    public static function getDistritos($cat_id) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        $list = Distrito::find()->andWhere(['depto_dtto' => $cat_id])->asArray()->all();
      //  echo $list->createCommand()->getRawSql();
        if (count($list) > 0) {
            foreach ($list as $i => $distrito) {
                $out[] = ['id' => $distrito['id_dtto'], 'name' => $distrito['des_dtto']];
            }
            return $out ;
        }

        return [];
    }

    public static function getSelectedDttos($cat_id,$param1) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $selected = [];
        $list = Distrito::find()->andWhere(['depto_dtto' => $cat_id,'id_dtto' => $param1 ])->asArray()->all();

        if (count($list) > 0) {
            foreach ($list as $i => $distrito) {
                $selected[] = ['id' => $distrito['id_dtto'], 'name' => $distrito['des_dtto']];
            }
            return $selected ;
        }

        return [];
    }
}
