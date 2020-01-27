<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */

$this->title = Yii::t('distrito', 'Create district / parish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('distrito', 'Distritos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distrito-create">
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
