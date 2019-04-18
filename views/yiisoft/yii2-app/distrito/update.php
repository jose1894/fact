<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */

$this->title = Yii::t('distrito', 'Update Distrito: {name}', [
    'name' => $model->id_dtto,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('distrito', 'Distritos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dtto, 'url' => ['view', 'id' => $model->id_dtto]];
$this->params['breadcrumbs'][] = Yii::t('distrito', 'Update');
?>
<div class="distrito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
