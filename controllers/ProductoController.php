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
        $this->layout = 'justStuff';

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
              $model->sucursal_prod = SiteController::getSucursal();
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
        $modelsListaP = $model->listas;
        $this->layout = "justStuff";

        if ($model->load(Yii::$app->request->post())) {

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
                $model->sucursal_prod = SiteController::getSucursal();
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                      if (!empty($deletedIDs)) {
                          ListaPrecios::deleteAll(['id_lista' => $deletedIDs]);
                      }

                        foreach ($modelsListaP as $modelListaP) {
                            $modelListaP->prod_lista = $model->id_prod;
                            $modelListaP->sucursal_lista = SiteController::getSucursal();
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

    public function actionProductoList($q = null, $id = null)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        $desc = is_null(Yii::$app->request->post( 'desc' )) ? null : Yii::$app->request->post( 'desc' );
        $tipo_listap = is_null(Yii::$app->request->post( 'tipo_listap' )) ? null : Yii::$app->request->post( 'tipo_listap' );
        $sucursal = SiteController::getSucursal();
        if ( !is_null( $desc ) && (is_null( $tipo_listap ) || trim($tipo_listap) === '' ) ) {

            $query = new Query;
            $query->select(['p.id_prod as id','p.cod_prod as cod_prod', 'p.des_prod as des_prod', 'p.texto AS text','des_und','stock_prod', 'ult_precio_compra'])
                ->from(['v_productos as p'])
                ->where('p.status_prod = 1')
                ->andWhere(['like', 'p.texto', $desc])
                //->andWhere(['>', 'p.stock_prod', 0])
                ->andWhere(['=', 'p.compra_prod', 1])
                ->andWhere(['=', 'p.status_prod', 1])
                ->andWhere('p.sucursal_prod = :sucursal',[':sucursal' => $sucursal])
                ->groupBy(['p.id_prod','p.cod_prod','p.des_prod', 'p.texto', 'des_und','stock_prod','ult_precio_compra'])
                ->orderBy('p.cod_prod ASC');
                //->limit(20);

            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values( $data );
            $out['sql'] = $query->createCommand()->sql;

        } elseif ( !is_null( $desc ) && (!is_null( $tipo_listap ) || trim($tipo_listap) !== '' )) {

            $query = new Query;
            $query->select(['p.id_prod as id','p.cod_prod as cod_prod', 'p.des_prod as des_prod',
                            'p.texto AS text','lp.precio_lista as precio', 'des_und','stock_prod'])
                ->from(['v_productos as p'])
                ->join('LEFT JOIN',
                       'lista_precios lp',
                       'lp.prod_lista =p.id_prod')
                ->where('p.status_prod = 1')
                //->andWhere(['>', 'p.stock_prod', 0])
                ->andWhere(['like', 'p.texto', $desc])
                ->andWhere(['=', 'p.venta_prod', 1])
                ->andWhere(['=', 'p.status_prod', 1])
                ->andWhere('lp.tipo_lista = :tipo_listap and p.sucursal_prod = :sucursal',
                          [':tipo_listap' =>  $tipo_listap, ':sucursal' => $sucursal])
                ->groupBy(['p.id_prod','p.cod_prod', 'p.des_prod','p.texto','lp.precio_lista', 'des_und','stock_prod'])
                ->orderBy('p.cod_prod ASC');

            $command = $query->createCommand();
            $data = $command->queryAll();
            $ret = [];
            foreach ( $data as $key => $value){
                $ret[$key] = [
                    'id' => $value['id'],
                    'cod_prod' => $value['cod_prod'],
                    'des_prod' => $value['des_prod'],
                    'text' => $value['text'],
                    'precio' => $value['precio'],
                    'des_und' => $value['des_und'],
                    'stock_prod' => $value['stock_prod'],
                ];

                if($value['stock_prod'] <= 0){
                    $ret[$key]['disabled'] = 1;
                }
            }
            $out['results'] =  $ret ;

//            $query = [];
//            $query = new Query;
//
//            $query->select(['p.id_prod as id','p.cod_prod as cod_prod', 'p.des_prod as des_prod',
//                'p.texto AS text','lp.precio_lista as precio', 'des_und','stock_prod'])
//                ->from(['v_productos as p'])
//                ->join('LEFT JOIN',
//                    'lista_precios lp',
//                    'lp.prod_lista =p.id_prod')
//                ->where('p.status_prod = 1')
//                ->andWhere(['<=', 'p.stock_prod', 0])
//                ->andWhere(['like', 'p.texto', $desc])
//                ->andWhere(['=', 'p.venta_prod', 1])
//                ->andWhere(['=', 'p.status_prod', 1])
//                ->andWhere('lp.tipo_lista = :tipo_listap and p.sucursal_prod = :sucursal',
//                    [':tipo_listap' =>  $tipo_listap, ':sucursal' => $sucursal])
//                ->groupBy(['p.id_prod','p.cod_prod', 'p.des_prod','p.texto','lp.precio_lista', 'des_und','stock_prod'])
//                ->orderBy('p.cod_prod ASC');
//
//            $command = $query->createCommand();
//            $data = $command->queryAll();
//            $out['disabled'] = array_values( $data );

        } elseif ( $id > 0 ) {

            $query = new Query;

            $query->select(['p.id_prod as id','p.cod_prod as cod_prod', 'p.des_prod as des_prod',
                            'p.texto AS text','lp.precio_lista as precio','des_und','stock_prod'])
                ->from(['v_productos as p'])
                ->join('LEFT JOIN',
                      'lista_precios lp',
                      'lp.prod_lista =p.id_prod')
                ->where('p.status_prod = 1')
                ->andWhere(['p.id_prod = :id',['id' =>  $id]]);

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
      $sucursal = SiteController::getSucursal();

      if ( !is_null( $id ) && Yii::$app->request->isAjax ) {
          $tipo_lista = Yii::$app->request->get( 'tipo_listap' );

          $query = new Query;
          $query->select(['lp.precio_lista as precio', 'p.impuesto_suc as impuesto', 'stock_prod as stock'])
              ->from(['v_productos as p'])
              ->join('LEFT JOIN',
                    'lista_precios lp',
                    'lp.prod_lista =p.id_prod')
              ->where('p.status_prod = 1')
              ->andWhere('p.id_prod = :id',['id' =>  $id])
              ->andWhere('lp.tipo_lista = :tipo_lista and p.sucursal_prod = :sucursal' ,
                          [':tipo_lista' =>  $tipo_lista, ':sucursal' => $sucursal])
              ->limit(1);

          $command = $query->createCommand();
          $data = $command->queryAll();

          $out[ 'results' ] = $data;
      }

      return $out;
     }

     public function actionProductCosto( $id )
     {

       \Yii::$app->response->format = Response::FORMAT_JSON;
       $out = ['results' => false];
       $sucursal = SiteController::getSucursal();

       if ( !is_null( $id ) && Yii::$app->request->isAjax ) {
           $tipo_lista = Yii::$app->request->get( 'tipo_listap' );

           $query = new Query;
           $query->select([
                 'lp.precio_lista as precio',
                 'p.impuesto_suc as impuesto',
                 'ult_precio_compra as costo',
                 'moneda_compra',
                 'tipo_moneda',
                 'stock_prod stock'
               ])
               ->from(['v_productos as p'])
               ->join('LEFT JOIN',
                     'lista_precios lp',
                     'lp.prod_lista =p.id_prod')
               ->where('p.status_prod = 1')
               ->andWhere('p.id_prod = :id',['id' =>  $id])
               ->andWhere('p.sucursal_prod = :sucursal' ,
                           [':sucursal' => $sucursal])
               ->limit(1);

           $command = $query->createCommand();
           $data = $command->queryAll();

           $out[ 'results' ] = $data;
           // $out[ 'sql' ] = $command->sql;
       }

       return $out;
      }
}
