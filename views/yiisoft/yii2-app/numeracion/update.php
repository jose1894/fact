<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pais */

$this->title = Yii::t('serie', 'Update numeration: {number}', [
	'number' => $model->id_num,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('serie', 'Numeration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_num, 'url' => ['view', 'id' => $model->id_num]];
$this->params['breadcrumbs'][] = Yii::t('pais', 'Update');
?>
<div class="numeration-update">
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
