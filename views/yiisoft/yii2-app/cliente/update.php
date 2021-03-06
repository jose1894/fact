<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('cliente', 'Customer: {number} / {name}', [
    'number' => $model->id_clte,
    'name' => $model->nombre_clte
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cliente', 'Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_clte, 'url' => ['view', 'id' => $model->id_clte]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cliente-update">
  <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= Html::encode($this->title) ?>
        </h3>
      </div>
      <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
      </div>
  </div>
</div>
