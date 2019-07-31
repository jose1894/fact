<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = Yii::t('compra', 'Create Compra');
$this->params['breadcrumbs'][] = ['label' => Yii::t('compra', 'Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetalles' => $modelsDetalles
    ]) ?>

</div>
