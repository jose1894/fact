<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotaIngreso */

$this->title = Yii::t('ingreso', 'Create entry note');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ingreso', 'Entry note'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nota-ingreso-create">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalles' => $modelsDetalles,
    ]) ?>
    </div>
  </div>
</div>
