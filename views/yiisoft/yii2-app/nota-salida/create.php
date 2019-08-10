<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotaSalida */

$this->title = Yii::t('tipo_movimiento', 'Create Nota Salida');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_movimiento', 'Nota Salidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nota-salida-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
