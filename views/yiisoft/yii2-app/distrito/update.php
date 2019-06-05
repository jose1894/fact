<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */

$this->title = Yii::t('distrito', 'Update district / parish: {<span class="label label-primary">{number}</span> {name}', [
    'number' => $model->id_dtto,
    'name' => $model->des_dtto
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('distrito', 'Distritos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dtto, 'url' => ['view', 'id' => $model->id_dtto]];
$this->params['breadcrumbs'][] = Yii::t('distrito', 'Update');
?>
<div class="distrito-update">
  <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?= $this->title ?>
        </h3>
      </div>
      <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>
  </div>
</div>
