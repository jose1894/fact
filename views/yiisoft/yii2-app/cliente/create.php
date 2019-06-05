<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('cliente', 'Create customer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cliente', 'Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-create">
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
