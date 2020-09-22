<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MotivoNcreditoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('motivo_ncredito', 'Motivo Ncreditos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motivo-ncredito-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('motivo_ncredito', 'Create Motivo Ncredito'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_motivo',
            'cod_motivo',
            'des_motivo',
            'status_motivo',
            'sucursal_motivo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
