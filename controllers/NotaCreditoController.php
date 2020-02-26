<?php

namespace app\controllers;

use app\models\PedidoDetalle;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\NotaCredito;
use app\models\NotaCreditoSearch;
use app\models\NotaSalida;
use app\models\NotaSalidaDetalle;
use app\models\NotaCreditoDetalle;
use app\models\Pedido;
use app\models\Producto;
use app\models\TipoCambio;
use app\models\Numeracion;
use app\models\TipoIdentificacion;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use NumerosEnLetras;
use DateTime;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\See;


/**
 * NotaCreditoController implements the CRUD actions for NotaCredito model.
 */
class NotaCreditoController extends Controller
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
     * Lists all NotaCredito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotaCreditoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Finds the NotaCredito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NotaCredito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NotaCredito::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('documento', 'The requested page does not exist.'));
    }


    /**
     * Creates a new Nota Credito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NotaCredito();
        return $this->render('create', [
            'model' => $model,
            'IMPUESTO' =>  SiteController::getImpuesto(),
        ]);
    }
}
