<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListaPrecios */

$this->title = Yii::t('lista_precios', 'Create Lista Precios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lista_precios', 'Lista Precios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lista-precios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
