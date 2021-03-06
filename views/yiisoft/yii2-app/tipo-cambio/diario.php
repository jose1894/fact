<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCambio */

$this->title = Yii::t('tipo_cambio', 'Exchange');
?>
<div class="tipo-cambio-create">
  <div class="box box-success">
    <div class="box-header with-border">
      <h1 class=""><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="box-body">
        <div class="container-fluid">
          <?= $this->render('_form', [
              'model' => $model,
          ]) ?>
        </div>
      </div>
    </div>
</div>
