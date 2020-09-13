<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_identificacion','Id type: {number} / {name}',[
  'number' => $model->id_tipod,
  'name' => $model->des_tipod
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_identificacion', 'Id type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-identificacion-view">
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
                  'id_tipoi',
                  'cod_tipoi',                  
                  'des_tipoi',
                  [
                    'attribute' => 'status_tipod',
                    'format' => 'raw',
                    'value' => $model->status_tipod ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                  ],
              ],
          ]) ?>
        </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
