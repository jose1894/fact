<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotaIngresoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nota-ingreso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_trans') ?>

    <?= $form->field($model, 'codigo_trans') ?>

    <?= $form->field($model, 'fecha_trans') ?>

    <?= $form->field($model, 'obsv_trans') ?>

    <?= $form->field($model, 'tipo_trans') ?>

    <?php // echo $form->field($model, 'docref_trans') ?>

    <?php // echo $form->field($model, 'almacen_trans') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_movimiento', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tipo_movimiento', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
