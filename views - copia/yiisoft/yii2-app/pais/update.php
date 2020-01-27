<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pais */

$this->title = Yii::t('pais', 'Update country: <span class="label label-primary">{number}</span> {name}', [
	'number' => $model->id_pais,
    'name' => $model->des_pais,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pais', 'Country'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pais, 'url' => ['view', 'id' => $model->id_pais]];
$this->params['breadcrumbs'][] = Yii::t('pais', 'Update');
?>
<div class="pais-update">
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
