<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoListap */

$this->title = Yii::t('tipo_listap', 'Update list price type: {number} / {name}', [
    'number' => $model->id_lista,
    'name' => $model->desc_lista
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_listap', 'Tipo Listaps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lista, 'url' => ['view', 'id' => $model->id_lista]];
$this->params['breadcrumbs'][] = Yii::t('tipo_listap', 'Update');
?>
<div class="tipo-listap-update">
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
