<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use yii\data\SqlDataProvider;
use app\models\TransaccionSearch;

class RptsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionKardex()
    {
      $searchModel = new TransaccionSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('_kardex', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);

      // $sqlCount = "select count(*)
      //               from
      //               (
      //               	select * from salidas_ajustes
      //                   union
      //                   select * from salidas_documentos
      //                   union
      //                   select * from salidas_proformas
      //                   union
      //                   select * from entradas_ajustes
      //                   union
      //                   select * from entradas_compras
      //                   union
      //                   select * from entradas_documentos
      //               ) as t";
      // $sqlSelect = "select *
      //               from
      //               (
      //               	select * from salidas_ajustes
      //                   union
      //                   select * from salidas_documentos
      //                   union
      //                   select * from salidas_proformas
      //                   union
      //                   select * from entradas_ajustes
      //                   union
      //                   select * from entradas_compras
      //                   union
      //                   select * from entradas_documentos
      //               ) as t";
      //
      // $count = Yii::$app->db->createCommand($sqlCount, [])->queryScalar();
      //
      // $provider = new SqlDataProvider([
      //     'sql' => $sqlSelect,
      //     //'params' => [':status' => 1],
      //     'totalCount' => $count,
      //     // 'pagination' => [
      //     //     'pageSize' => 20,
      //     // ],
      //     'pagination' => false,
      //     'sort' => [
      //         'attributes' => [
      //             'title',
      //             'view_count',
      //             'created_at',
      //         ],
      //     ],
      // ]);
      //
      // // returns an array of data rows
      // $models = $provider->getModels();
      //
      // // print_r($models);exit();
      // return $this->render('_kardex',['model' => $models]);
    }


}
