<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */

$this->title = Yii::t('provincia', 'Update estate / province: {number} / {name}', [
    'number' => $model->id_prov,
    'name' => $model->des_prov
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('provincia', 'Estate / pronvice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prov, 'url' => ['view', 'id' => $model->id_prov]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="provincia-update">
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
