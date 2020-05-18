<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoTraslado */

$this->title = Yii::t('motivo_traslado', 'Create transfer reason');
$this->params['breadcrumbs'][] = ['label' => Yii::t('motivo_traslado', 'Transfer reason'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-producto-create">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
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
