<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CondPago */

$this->title =  Yii::t('condicionp', 'Payment condition: <span class="label label-primary">{number}</span> {name}',
    [ 'number' => $model->id_condp,
     'name' => $model->desc_condp]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('condicionp', 'Payment condition: <span class="label label-primary">{number}</span> {name}',
    [ 'number' => $model->id_condp,
     'name' => $model->desc_condp]), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_condp;
\yii\web\YiiAsset::register($this);
?>
<div class="cond-pago-view">
<div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= $this->title ?>
      </h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id_condp',
                    'desc_condp',
                    [
                        'attribute' => 'status_condp',
                        'format' => 'raw',
                        'value' => $model->status_condp ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                      ],
                    //'sucursal_condp',
                ],
            ]) ?>
        </div>
    </div>
</div>
