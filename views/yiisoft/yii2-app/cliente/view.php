<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('cliente', 'Client: <span class="badge bg-primary">{number}</span> {name}', [
    'number' => $model->id_clte,
    'name' => $model->nombre_clte
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cliente', 'Cliente'), 'url' => ['index']];
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
              'depto_cte',
              'provi_cte',
              'dtto_clte',
              'tlf_ctle',
              'vendedor_clte',
              'estatus_ctle',
              'condp_clte',
              'sucursal_clte',
          ],
      ]) ?>

    </div>
  </div>
</div>
