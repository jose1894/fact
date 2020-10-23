<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */

$this->title = Yii::t('provincia', 'Create municipality / province');
$this->params['breadcrumbs'][] = ['label' => Yii::t('provincia', 'Municipality / Province'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provincia-create">
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
