<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */

$this->title = Yii::t('serie','Serie: {number} / {name}',[
  'number' => $model->id_serie,
  'name' => $model->des_serie
]);;
$this->params['breadcrumbs'][] = ['label' => Yii::t('serie', 'Serie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="serie-view">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_serie',
                'des_serie',
                [
                  'attribute' => 'status_serie',
                  'format' => 'raw',
                  'value' => $model->status_serie ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                //'sucursal_serie',
            ],
        ]) ?>
      </div>
    </div>
  </div>
</div>
