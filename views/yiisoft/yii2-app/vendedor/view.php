<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */

$this->title = Yii::t('vendedor',"Seller: {number} / {name}",[
  'number' => $model->id_vendedor,
  'name' => $model->nombre_vend
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('vendedor', 'Sellers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendedor-view">
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
                  'id_vendedor',
                  'dni_vend',
                  'nombre_vend',
                  'tlf_vend',
                  [
                    'attribute' => 'estatus_vend',
                    'format' => 'raw',
                    'value' => $model->estatus_vend ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                  ],
                  [
                    'attribute' => 'zona_vend',
                    'value' => $model->zonaVend->nombre_zona
                  ],
              ],
          ]) ?>

        </div>
      </div>
    </div>
</div>
