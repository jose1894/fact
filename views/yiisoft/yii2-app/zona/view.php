<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Zona */

$this->title = Yii::t('zona',"Zone: <span class='label label-primary'>{number}</span> {name}",[ 'number' => $model->id_zona, 'name' => $model->nombre_zona]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('zona', 'Zonas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="zona-view">
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
                  'id_zona',
                  'nombre_zona',
                  'desc_zona:ntext',
                  [
                    'attribute' => 'estatus_zona',
                    'format' => 'raw',
                    'value' => $model->estatus_zona ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                  ],
              ],
          ]) ?>

        </div>
      </div>
    </div>
</div>
