<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_documento','Document type: <span class="label label-primary">{number}</span> {name}',[
  'number' => $model->id_tipod,
  'name' => $model->des_tipod
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_documento', 'Document type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-documento-view">
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
                  'id_tipod',
                  'des_tipod',                  
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
