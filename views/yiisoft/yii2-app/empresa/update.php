<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('empresa', 'Update Empresa: {name}', [
    'name' => $model->dni_empresa,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('empresa', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dni_empresa, 'url' => ['view', 'id' => $model->dni_empresa]];
$this->params['breadcrumbs'][] = Yii::t('empresa', 'Update');
?>
<div class="empresa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
