<?php

namespace app\controllers;

use Yii;
use app\models\Documento;
use app\models\NotaSalida;
use app\models\NotaSalidaDetalle;
use app\models\Pedido;
use app\models\DocumentoSearch;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentoController implements the CRUD actions for Documento model.
 */
class DocumentoController extends Controller
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
     * Lists all Documento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documento model.
     * @param integer $id
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
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Documento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_doc]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_doc]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Documento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
    }

    public function actionPedidosPendientes()
    {
      //$this->layout = "justStuff";
      $searchModel = new PedidoSearch();
      $searchModel->estatus_pedido = Pedido::STATUS_INACTIVO;
      $searchModel->tipo_pedido = Pedido::PEDIDO;
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('listado-generar', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
    }

    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionFacturaCreate( $id )
    {
        $model = new Documento();
        $model->scenario = Documento::SCENARIO_FACTURA;
        $modelPedido = Pedido::findOne( $id );

        if ( $modelPedido === null) {
            throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
        }

        $post = Yii::$app->request->post();
        if ($model->load($post)) {
          $modelNotaSalida = new NotaSalida();
          $modelNotaSalidaDetalle = [new NotaSalidaDetalle()];

          $notaSalidaDetalle = [];
          foreach ($post['PedidoDetalle'] as $key => $value) {
            $notaSalidaDetalle[$key] = ['prod_detalle' => $value['prod_detalle'],'cant_detalle' => $value['cant_pdetalle']];
          }

          $modelNotaSalida->sucursal_trans = SiteController::getSucursal();
          $modelNotaSalida->usuario_trans = Yii::$app->user->id;
          $modelNotaSalida->ope_trans = $model::OPE_TRANS;
          $num = Numeracion::getNumeracion( $model->tipo_doc, Numeracion::ES_DOCUMENTO );
          $codigo = intval( $num['numero_num'] ) + 1;
          $codigo = str_pad($codigo,10,'0',STR_PAD_LEFT);
          $modelNotaSalida->codigo_trans = $codigo;
        /*  $modelsDetalles = Model::createMultiple(NotaSalidaDetalle::classname());
          Model::loadMultiple($modelsDetalles, Yii::$app->request->post());

          // validate all models
          $valid = $model->validate();
          $valid = Model::validateMultiple($modelsDetalles) && $valid;*/
        }

        $this->layout = 'justStuff';
        return $this->render('_formDocumento', [
            'model' => $model,
            'modelPedido' => $modelPedido,
            'IMPUESTO' => SiteController::getImpuesto(),
        ]);
    }


}
