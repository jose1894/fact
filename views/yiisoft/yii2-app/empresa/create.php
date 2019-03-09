<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('empresa', 'Create company');
$this->params['breadcrumbs'][] = ['label' => Yii::t('empresa', 'Company'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-create">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
          <?= $this->render('_frameform', [
              'model' => $model,
              'modelsSucursal' => $modelsSucursal
          ]) ?>
        </div>
      </div>
    </div>
</div>
