<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */

$this->title = Yii::t('moneda','Currency: {number} / {name}',[
  'number' => $model->id_moneda,
  'name' => $model->des_moneda
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('moneda', 'Monedas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="moneda-view">
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
                'id_moneda',
                'des_moneda',
                [
                  'attribute' => 'tipo_moneda',
                  'format' => 'raw',
                  'value' => $model->tipo_moneda == 'N' ? 'Nacional' : 'Extranjero'
                ],
                'sunatm_moneda',
                [
                  'attribute' => 'status_moneda',
                  'format' => 'raw',
                  'value' => $model->status_moneda ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                ],
                //'sucursal_moneda',
            ],
        ]) ?>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
</div>
