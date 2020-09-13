<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transportista */

$this->title = Yii::t('transportista','Carrier: {number} / {name}',[
  'number' => $model->id_transp,
  'name' => $model->des_transp
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('transportista', 'Transportistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transportista-view">
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
                  'id_transp',
                  'ruc_transp',
                  'des_transp',
                  [
                    'attribute' => 'status_transp',
                    'format' => 'raw',
                    'value' => $model->status_transp ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                  ],
              ],
          ]) ?>
        </div>
    </div>
            <!-- /.box-body -->
  </div>
</div>
