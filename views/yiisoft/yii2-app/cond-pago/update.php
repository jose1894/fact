<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CondPago */

$this->title = Yii::t('condicionp', 'Update payment condition: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_condp,
    'name' => $model->desc_condp,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('condicionp', 'Payment condition'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_condp, 'url' => ['view', 'id' => $model->id_condp]];
$this->params['breadcrumbs'][] = Yii::t('condicionp', 'Update');
?>
<div class="cond-pago-update">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $this->title ?></h3>
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
