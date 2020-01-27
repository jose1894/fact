<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = Yii::t('compra', 'Create purchase order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('compra', 'Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-create">
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
        'IMPUESTO' => $IMPUESTO
    ]) ?>
    </div>
  </div>
</div>
