<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Numeracion */

$this->title = Yii::t('numeracion', 'Update Numeracion: {name}', [
    'name' => $model->id_num,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('numeracion', 'Numeracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_num, 'url' => ['view', 'id' => $model->id_num]];
$this->params['breadcrumbs'][] = Yii::t('numeracion', 'Update');
?>
<div class="numeracion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
