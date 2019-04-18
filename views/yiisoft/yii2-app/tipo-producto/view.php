<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */

$this->title = Yii::t('tipo_producto','Product type: <span class="label label-primary">{number}</span> {name}',[ 'number' => $model->id_tpdcto, 'name' => $model->desc_tpdcto]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_producto', 'Product types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-producto-view">
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
                  'id_tpdcto',
                  'desc_tpdcto',
                  //'status_tpdcto',
                  [
                    'attribute' => 'status_tpdcto',
                    'format' => 'raw',
                    'value' => $model->status_tpdcto ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                  ],
              ],
          ]) ?>
        </div>
    </div>
          <!-- /.box-body -->
  </div>
</div>
