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
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

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
      $this->layout = 'justStuff';

      $model = $this->findModel($id);
      $modelsSucursal = $model->sucursales;

      return $this->render('view', [
          'model' => $model,
          'modelsSucursal' => $modelsSucursal,
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
        $modelsSucursal = [new Sucursal];
        $this->layout = "justStuff";

        if ($model->load(Yii::$app->request->post())) {
            $imageNew = UploadedFile::getInstance($model, 'image');
            $cert = UploadedFile::getInstance($model, 'cert');

            $modelsSucursal = Model::createMultiple(Sucursal::classname(),[],'id_suc');
            Model::loadMultiple($modelsSucursal, Yii::$app->request->post());

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsSucursal) && $valid;

            // ajax validation
            if (!$valid)
            {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsSucursal),
                        ActiveForm::validate($model)
                    );
                }
            }
            else
            {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if ($imageNew) {
                            $id = $model->id_empresa;
                            $nombreEmpresa = str_replace(' ', '_', $model->nombre_empresa);
                            $carpeta = $id.'_'.$nombreEmpresa;
                            Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/companies/'.$carpeta.'/';

                            $fileName = $imageNew->name;
                            $model->image = $fileName;
                            $ext = explode(".", $fileName);
                            $ext = end($ext);

                            /**Se verifica si existe el directorio donde se guardara la iamgen */
                            if (!is_dir(Yii::$app->params['uploadPath'])) {
                                /**se crea el directorio donde se guardara la imagen y se da permiso de acceso */
                                if ( !FileHelper::createDirectory(Yii::$app->params['uploadPath'],0777,true)) {
                                  $transaction->rollBack();
                                  throw new \Exception("Error creating folder ". Yii::$app->params['uploadPath'], 1);
                                }
                            }

                            // generate a unique file name
                            $avatar = Yii::$app->security->generateRandomString().".{$ext}";
                            $path = Yii::$app->params['uploadPath']. $avatar;
                            $imageNew->saveAs($path);
                            $model->image_empresa = '/web/uploads/companies/'.$carpeta.'/'. $avatar;
                            $flag = $model->save(false) && $flag;
                        }

                        if ($cert) {
                            $id = $model->id_empresa;
                            $nombreEmpresa = str_replace(' ', '_', $model->nombre_empresa);
                            $carpeta = $id.'_'.$nombreEmpresa;
                            Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/companies/'.$carpeta.'/certs/';

                            $fileName = $cert->name;
                            $model->cert = $fileName;
                            $ext = explode(".", $fileName);
                            $ext = end($ext);

                            /**Se verifica si existe el directorio donde se guardara la iamgen */
                            if (!is_dir(Yii::$app->params['uploadPath'])) {
                                /**se crea el directorio donde se guardara la imagen y se da permiso de acceso */
                                if ( !FileHelper::createDirectory(Yii::$app->params['uploadPath'],0777,true)) {
                                  $transaction->rollBack();
                                  throw new \Exception("Error creating folder ". Yii::$app->params['uploadPath'], 1);
                                }
                            }

                            // generate a unique file name
                            $avatar = Yii::$app->security->generateRandomString().".{$ext}";
                            $path = Yii::$app->params['uploadPath']. $avatar;
                            $cert->saveAs($path);
                            $model->cert_empresa = $avatar;
                            $flag = $model->save(false) && $flag;
                        }

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
                        $return = [
                          'success' => true,
                          'title' => Yii::t('empresa', 'Company'),
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
                      'title' => Yii::t('empresa', 'Company'),
                      'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                      'type' => 'error'

                    ];
                    return $return;
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsSucursal' => (empty($modelsSucursal)) ? [new Sucursal] : $modelsSucursal
        ]);

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

        $modelsSucursal = $model->sucursales;
        $this->layout = "justStuff";

        if ($model->load(Yii::$app->request->post())) {

            //exit( "post aki" );
            $oldIDs = ArrayHelper::map($modelsSucursal, 'id_suc', 'id_suc');
            $modelsSucursal = Model::createMultiple(Sucursal::classname(), $modelsSucursal,'id_suc');
            Model::loadMultiple($modelsSucursal, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsSucursal, 'id_suc', 'id_suc')));

            $imageNew = UploadedFile::getInstance($model, 'image');

            $cert = UploadedFile::getInstance($model, 'cert');


            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsSucursal) && $valid;

            // ajax validation
            if (!$valid)
            {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsSucursal),
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
                            Sucursal::deleteAll(['id_suc' => $deletedIDs]);
                        }

                        foreach ($modelsSucursal as $modelSucursal) {
                            $modelSucursal->empresa_suc = $model->id_empresa;
                            if (! ($flag = $modelSucursal->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                        // si carga nueva imagen
                        if ($imageNew) {
                          //Si carga imagen nueva
                          $id = $model->id_empresa;
                          $nombreEmpresa = str_replace(' ', '_', $model->nombre_empresa);
                          $carpeta = $id.'_'.$nombreEmpresa;
                          Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/companies/'.$carpeta.'/';

                          $fileName = $imageNew->name;
                          $model->image = $fileName;
                          $ext = explode(".", $fileName);
                          $ext = end($ext);

                          /**Se verifica si existe el directorio donde se guardara la iamgen */
                          if (!is_dir(Yii::$app->params['uploadPath'])) {
                              /**se crea el directorio donde se guardara la imagen y se da permiso de acceso */
                              if ( !FileHelper::createDirectory(Yii::$app->params['uploadPath'],0777,true)) {
                                $transaction->rollBack();
                                throw new \Exception("Error creating folder ". Yii::$app->params['uploadPath'], 1);
                              }
                          }

                          if ( $model->image_empresa ) {
                            if ( is_file(Yii::$app->params['uploadPath'].$model->image_empresa) ) {
                              unlink(Yii::$app->params['uploadPath'].$model->image_empresa);
                            }
                          }

                          // generate a unique file name
                          $avatar = Yii::$app->security->generateRandomString().".{$ext}";
                          $path = Yii::$app->params['uploadPath']. $avatar;
                          $imageNew->saveAs($path);
                          $model->image_empresa = $avatar;
                          $flag = $model->save(false) && $flag;
                        }

                        // si carga nuevo certificado
                        if ($cert) {
                          //Si carga imagen nueva
                          $id = $model->id_empresa;
                          $nombreEmpresa = str_replace(' ', '_', $model->nombre_empresa);
                          $carpeta = $id.'_'.$nombreEmpresa;
                          Yii::$app->params['uploadPath'] = Yii::$app->basePath.'/web/uploads/companies/'.$carpeta.'/certs/';

                          $fileName = $cert->name;
                          $model->image = $fileName;
                          $ext = explode(".", $fileName);
                          $ext = end($ext);

                          /**Se verifica si existe el directorio donde se guardara la iamgen */
                          if (!is_dir(Yii::$app->params['uploadPath'])) {
                              /**se crea el directorio donde se guardara la imagen y se da permiso de acceso */
                              if ( !FileHelper::createDirectory(Yii::$app->params['uploadPath'],0777,true)) {
                                $transaction->rollBack();
                                throw new \Exception("Error creating folder ". Yii::$app->params['uploadPath'], 1);
                              }
                          }

                          if ( $model->cert_empresa ) {
                              if ( is_file(Yii::$app->params['uploadPath'].$model->cert_empresa) ) {
                                  unlink(Yii::$app->params['uploadPath'].$model->cert_empresa);
                              }
                          }

                          // generate a unique file name
                          $avatar = Yii::$app->security->generateRandomString().".{$ext}";
                          $path = Yii::$app->params['uploadPath']. $avatar;
                          $cert->saveAs($path);
                          $model->cert_empresa = $avatar;
                          $flag = $model->save(false) && $flag;
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->redirect(['view', 'id' => $model->id_empresa]);
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('empresa', 'Company'),
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
                      'title' => Yii::t('empresa', 'Company'),
                      'message' => Yii::t('app','Record couldn´t be saved!') . " \nError: ". $e->errorMessage(),
                      'type' => 'error'

                    ];
                    return $return;
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsSucursal' => (empty($modelsSucursal)) ? [new Sucursal] : $modelsSucursal
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

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return 1;
        }

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

    public function actionSucursales()
    {
      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      $out = ['output' => '', 'selected' => ''];
      $parent = Yii::$app->request->post('depdrop_parents');

      if ( isset( $parent[0] ) ) {
        $param = Yii::$app->request->post('depdrop_params');
        $selected = [];
        $sucursales = $this->findModel( $parent )->sucursales;

        foreach ($sucursales as $key => $sucursal) {
          $arrSucursales[] = ['id' => $sucursal->id_suc, 'name' => $sucursal->nombre_suc];

          if ( !empty( $param )){
            if ( $sucursal->id_suc === (int) $param){
              $selected = ['id' => $sucursal->id_suc, 'name' => $sucursal->nombre_suc];
            }
          }
        }

        $out =  ['output' => $arrSucursales, 'selected' => $selected];
      }

      return $out;
   }

   /*Devuelve el nombre de la empresa*/
   public static function getEmpresa()
   {
     return Empresa::getEmpresa()->nombre_empresa;
   }
}
