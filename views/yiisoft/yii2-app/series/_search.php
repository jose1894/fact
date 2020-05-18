<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="series-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_serie') ?>

    <?= $form->field($model, 'des_serie') ?>

    <?= $form->field($model, 'status_serie') ?>

    <?= $form->field($model, 'sucursal_serie') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('series', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('series', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
