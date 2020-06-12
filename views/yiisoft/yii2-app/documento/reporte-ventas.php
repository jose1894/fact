<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Cliente;
use app\models\Pedido;
use app\models\Vendedor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = Yii::t('documento','Sales report');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'grid']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
          [
              'attribute' => 'cod_doc',
              'width' => '5%'
          ],
          [
            // 'format' => 'date',
            'width' => '25%',
            'value' => function($data){
                 return Yii::$app->formatter->asDate($data->fecha_doc, 'dd/MM/yyyy');
            },
            'attribute' => 'fecha_doc',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'filterType' => GridView::FILTER_DATE_RANGE,
        ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
