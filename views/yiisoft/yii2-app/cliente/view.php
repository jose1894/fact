<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
// 'style' => 'width: 20%'

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('cliente', 'Customer: <span class="label label-primary">{number}</span> {name}', [
    'number' => $model->id_clte,
    'name' => $model->nombre_clte
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cliente', 'Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cliente-view">
  <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= $this->title ?>
        </h3>
      </div>
      <div class="box-body">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id_clte',
              'dni_clte',
              'ruc_clte',
              'nombre_clte',
              'direcc_clte:ntext',
              [
                'valueColOptions'=>['style'=>'width:30%'],
                'attribute' => 'pais_cte',
                'value' => $model->paisClte->des_pais,
                'width' => '80%',
              ],
              [
                'attribute' => 'provi_cte',
                'value' => $model->provClte->des_prov
              ],
              [
                'attribute' => 'depto_cte',
                'value' => $model->deptoClte->des_depto
              ],
              [
                'attribute' => 'dtto_clte',
                'value' => $model->dttoClte->des_dtto
              ],
              'tlf_ctle',
              [
                'attribute' => 'vendedor_clte',
                'value' => $model->vendedorClte->nombre_vend
              ],
              [
                'attribute' => 'condp_clte',
                'value' => $model->condpClte->desc_condp
              ],
              [
                'attribute' => 'estatus_ctle',
                'format' => 'raw',
                'value' => $model->estatus_ctle ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
              ],
          ],
      ]) ?>

    </div>
  </div>
</div>
