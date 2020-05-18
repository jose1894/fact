<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoListap */

$this->title = Yii::t('tipo_listap', 'Create list price type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_listap', 'Tipo Listaps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-listap-create">
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
