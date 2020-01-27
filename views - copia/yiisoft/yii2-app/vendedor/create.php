<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendedor */

$this->title = Yii::t('vendedor', 'Create seller');
$this->params['breadcrumbs'][] = ['label' => Yii::t('vendedor', 'Sellers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendedor-create">
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
