<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DistritoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distrito-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_dtto') ?>

    <?= $form->field($model, 'des_dtto') ?>

    <?= $form->field($model, 'depto_dtto') ?>

    <?= $form->field($model, 'status_dtto') ?>

    <?= $form->field($model, 'sucursal_dtto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('distrito', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('distrito', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
