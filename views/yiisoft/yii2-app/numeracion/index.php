<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NumeracionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('numeracion', 'Numeracions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="numeracion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('numeracion', 'Create Numeracion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_num',
            'tipo_num',
            'numero_num',
            'sucursal_num',
            'serie_num',
            //'status_num',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
