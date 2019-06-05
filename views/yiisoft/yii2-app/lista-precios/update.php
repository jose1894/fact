<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListaPrecios */

$this->title = Yii::t('lista_precios', 'Update Lista Precios: {name}', [
    'name' => $model->id_lista,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('lista_precios', 'Lista Precios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lista, 'url' => ['view', 'id' => $model->id_lista]];
$this->params['breadcrumbs'][] = Yii::t('lista_precios', 'Update');
?>
<div class="lista-precios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
