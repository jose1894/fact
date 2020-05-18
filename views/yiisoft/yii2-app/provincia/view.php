<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */

$this->title = Yii::t('provincia','Estate / Province: <span class="label label-primary">{number}</span> {name}',[
  'number' => $model->id_prov,
  'name' => $model->des_prov
]);;
$this->params['breadcrumbs'][] = ['label' => Yii::t('provincia', 'Estate / Province'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="provincia-view">
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
                'id_prov',
                'des_prov',
                [
                  'attribute' => 'pais_prov',
                  'value' => $model->paisProv->des_pais
                ],
                [
                  'attribute' => 'status_prov',
                  'format' => 'raw',
                  'value' => $model->status_prov ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                //'sucursal_prov',
            ],
        ]) ?>
      </div>
    </div>
  </div>
</div>
