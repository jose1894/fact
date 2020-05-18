<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CondPagoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cond-pago-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_condp') ?>

    <?= $form->field($model, 'desc_condp') ?>

    <?= $form->field($model, 'status_condp') ?>

    <?= $form->field($model, 'sucursal_condp') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('condicionp', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('condicionp', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
