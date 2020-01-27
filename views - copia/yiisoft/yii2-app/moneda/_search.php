<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MonedaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moneda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_moneda') ?>

    <?= $form->field($model, 'des_moneda') ?>

    <?= $form->field($model, 'tipo_moneda') ?>

    <?= $form->field($model, 'status_moneda') ?>

    <?= $form->field($model, 'sucursal_moneda') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('moneda', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('moneda', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
