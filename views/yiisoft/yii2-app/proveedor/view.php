<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = Yii::t('proveedor', 'Supplier: {number} / {name}', [
    'number' => $model->id_prove,
    'name' => $model->nombre_prove
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('proveedor', 'Proveedors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proveedor-view">
  <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= Html::encode($this->title) ?>
        </h3>
      </div>
      <div class="box-body">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id_prove',
              'dni_prove',
              'ruc_prove',
              'nombre_prove',
              'direcc_prove:ntext',
              [
                'valueColOptions'=>['style'=>'width:30%'],
                'attribute' => 'pais_prove',
                'value' => $model->paisProve->des_pais,
                'width' => '80%',
              ],
              [
                'attribute' => 'provi_prove',
                'value' => $model->proviProve->des_prov
              ],
              [
                'attribute' => 'depto_prove',
                'value' => $model->deptoProve->des_depto
              ],
              [
                'attribute' => 'dtto_prove',
                'value' => $model->dttoProve->des_dtto
              ],
              /*[
                'attribute' => 'condp_clte',
                'value' => $model->condpClte->desc_condp
              ],*/
              'tipo_prove',
              [
                'attribute' => 'status_prove',
                'format' => 'raw',
                'value' => $model->status_prove ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
              ]
          ],
      ]) ?>
    </div>
  </div>
</div>
