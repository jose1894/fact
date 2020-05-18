<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('empresa', 'Update company: {name}', [
    'name' => $model->nombre_empresa,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('empresa', 'Company'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dni_empresa, 'url' => ['view', 'id' => $model->dni_empresa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="empresa-update">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">

            <?= $this->render('_frameForm', [
                'model' => $model,
                'modelsSucursal' => $modelsSucursal
            ]) ?>
        </div>
      </div>
    </div>
</div>
