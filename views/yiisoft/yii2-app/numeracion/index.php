<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\TipoDocumento;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NumeracionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('numeracion', 'Numertation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="numeracion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin([ 'id' => 'grid' ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('numeracion', 'Create numeration'), ['create','asDialog' => 1], ['id' => 'create','class' => 'btn btn-flat btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'attribute'=>'id_num',
              'width' => '5%'
            ],
            [
              'attribute'=>'tipo_num',
              'value' => function($data){
                   return $data->tipoNum->des_tipod;
              },
              'filter'=>TipoDocumento::getTipoDocumento(),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],

            ],
            'serie_num',
            'numero_num',
            //'sucursal_num',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status_num',
                'vAlign' => 'middle',
                'width' => '10%'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
