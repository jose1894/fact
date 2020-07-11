<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use yii\data\SqlDataProvider;

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

    public function actionKardex() {
      $count = Yii::$app->db->createCommand('
          SELECT COUNT(*) FROM post WHERE status=:status
      ', [':status' => 1])->queryScalar();

      $provider = new SqlDataProvider([
          'sql' => 'SELECT * FROM post WHERE status=:status',
          'params' => [':status' => 1],
          'totalCount' => $count,
          'pagination' => [
              'pageSize' => 10,
          ],
          'sort' => [
              'attributes' => [
                  'title',
                  'view_count',
                  'created_at',
              ],
          ],
      ]);

      // returns an array of data rows
      $models = $provider->getModels();

      return $this->render('_kardex',[]);
    }


}
