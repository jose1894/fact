<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCambio */

$this->title = Yii::t('tipo_cambio', 'Create Tipo Cambio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tipo_cambio', 'Tipo Cambios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-cambio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
