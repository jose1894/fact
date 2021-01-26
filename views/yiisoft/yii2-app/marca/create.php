<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */

$this->title = Yii::t('marca', 'Create make');
$this->params['breadcrumbs'][] = ['label' => Yii::t('marca', 'Makes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marca-create">
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
