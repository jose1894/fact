<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('pedido', 'Create purchase order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('pedido', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-create">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalles' => $modelsDetalles,
      //  'searchModel' => $searchModel,
        //'dataProvider' => $dataProvider,
    ]) ?>
    </div>
  </div>
</div>
