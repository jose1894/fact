<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Numeracion */

$this->title = Yii::t('numeracion', 'Create Numeracion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('numeracion', 'Numeracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="numeracion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
