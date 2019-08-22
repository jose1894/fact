<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\numeracion */

$this->title = Yii::t('numeracion', 'Create numeration');
$this->params['breadcrumbs'][] = ['label' => Yii::t('numeracion', 'Numeration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="numeracion-create">

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
