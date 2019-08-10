<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotaIngreso */

$this->title = Yii::t('tipo_movimiento', 'Create Nota Ingreso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_movimiento', 'Nota Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nota-ingreso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
