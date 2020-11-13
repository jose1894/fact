<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use yii\db\Query;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
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
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
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
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cliente();

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
              $model->sucursal_clte = SiteController::getSucursal();
              $transaction = \Yii::$app->db->beginTransaction();

              try {
                      $model->save();
                      $transaction->commit();
                      //return $this->redirect(['view', 'id' => $model->id_empresa]);
                      Yii::$app->response->format = Response::FORMAT_JSON;
                      $return = [
                        'success' => true,
                        'title' => Yii::t('cliente', 'Customer'),
                        'message' => Yii::t('app','Record has been saved successfully!'),
                        'type' => 'success'
                      ];
                      return $return;

              } catch (Exception $e) {
                  $transaction->rollBack();
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  $return = [
                    'success' => false,
                    'title' => Yii::t('cliente', 'Customer'),
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
     * Updates an existing Cliente model.
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
                $model->sucursal_clte = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                        $model->save();
                        $transaction->commit();
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        $return = [
                          'success' => true,
                          'title' => Yii::t('cliente', 'Customer'),
                          'message' => Yii::t('app','Record has been saved successfully!'),
                          'type' => 'success'
                        ];
                        return $return;
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = [
                      'success' => false,
                      'title' => Yii::t('cliente', 'Customer'),
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
     * Deletes an existing Cliente model.
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
             return true;
         }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('ciente', 'The requested page does not exist.'));
    }

    public function actionClienteList($q = null, $id = null) {
		//exit('ak');
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $sucursal = SiteController::getSucursal();
        $out = ['results' => ['id' => '', 'text' => '']];

        if ( !is_null( $q ) ) {
            $query = new Query;

            $query->select(['c.id_clte as id', 'concat(ruc_clte," - ",c.nombre_clte) AS text'])
                ->from(['cliente as c'])
                ->join('left join ', ['distrito as dt'],' c.dtto_clte = dt.id_dtto and dt.status_dtto = 1 and sucursal_dtto = '.$sucursal)
                ->join('left join ', ['provincia as pr'] ,' c.provi_cte = pr.id_prov and pr.status_prov = 1 and sucursal_prov = '.$sucursal)
                ->join('left join ', ['departamento as dp'],' c.depto_cte = dp.id_depto and dp.status_depto = 1 and sucursal_depto = '. $sucursal)
                ->join('left join ', ['pais as p'],' c.pais_cte = p.id_pais and p.status_pais = 1 and sucursal_pais = '.$sucursal)
                ->where('c.estatus_ctle = 1')
                ->andWhere(['like', 'c.nombre_clte', $q])
                ->orWhere(['like', 'c.ruc_clte', $q])
                ->orWhere(['like', 'c.dni_clte', $q])
                ->andWhere('c.sucursal_clte = :sucursal', [':sucursal' => $sucursal])
                ->limit(20);

            $command = $query->createCommand();
            $data = $command->queryAll();

            $out[ 'results' ] = array_values( $data );
        } elseif ( $id > 0 ) {
          $query = new Query;

          $query->select(['c.id_clte as id','c.vendedor_clte as vendedor', 'c.nombre_clte AS text','c.direcc_clte', 'condp_clte as condp',
                          'CONCAT(dt.des_dtto,\' - \', dp.des_depto,\' - \',pr.des_prov, \' - \',p.des_pais) as \'geo\'','lista_clte as tpl','dni_clte','ruc_clte', 'tipoid_clte'])
              ->from(['cliente as c'])
              ->join('left join ', ['distrito as dt'],' c.dtto_clte = dt.id_dtto and dt.status_dtto = 1 and sucursal_dtto = '.$sucursal)
              ->join('left join ', ['provincia as pr'] ,' c.provi_cte = pr.id_prov and pr.status_prov = 1 and sucursal_prov = '.$sucursal)
              ->join('left join ',['departamento as dp'],' c.depto_cte = dp.id_depto and dp.status_depto = 1 and sucursal_depto = '. $sucursal)
              ->join('left join ',['pais as p'],' c.pais_cte = p.id_pais and p.status_pais = 1 and sucursal_pais = '.$sucursal)
              ->andWhere('c.id_clte = :id_clte and c.sucursal_clte = :sucursal', [':id_clte' => $id, ':sucursal' => $sucursal ] )
              ->limit(1);
        			 //echo $query->createCommand()->sql;
        			 //exit();
          $command = $query->createCommand();
          $data = $command->queryAll();

          $out = array_values( $data  );

        }

        return $out;
    }
}
