<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transportista */

$this->title = Yii::t('transportista', 'Create Transportista');
$this->params['breadcrumbs'][] = ['label' => Yii::t('transportista', 'Transportistas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transportista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
