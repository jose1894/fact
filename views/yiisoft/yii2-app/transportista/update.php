<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transportista */

$this->title = Yii::t('transportista', 'Update Transportista: {name}', [
    'name' => $model->id_transp,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('transportista', 'Transportistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_transp, 'url' => ['view', 'id' => $model->id_transp]];
$this->params['breadcrumbs'][] = Yii::t('transportista', 'Update');
?>
<div class="transportista-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
