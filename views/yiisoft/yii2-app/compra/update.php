<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = Yii::t('compra', 'Update Compra: {name}', [
    'name' => $model->id_compra,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('compra', 'Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_compra, 'url' => ['view', 'id' => $model->id_compra]];
$this->params['breadcrumbs'][] = Yii::t('compra', 'Update');
?>
<div class="compra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
