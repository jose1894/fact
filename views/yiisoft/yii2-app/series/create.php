<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */

$this->title = Yii::t('serie', 'Create serie');
$this->params['breadcrumbs'][] = ['label' => Yii::t('serie', 'Serie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="serie-create">
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
