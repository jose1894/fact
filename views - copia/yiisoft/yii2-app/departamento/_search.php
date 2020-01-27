<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_depto') ?>

    <?= $form->field($model, 'des_depto') ?>

    <?= $form->field($model, 'prov_depto') ?>

    <?= $form->field($model, 'status_depto') ?>

    <?= $form->field($model, 'sucursal_depto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('departamento', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('departamento', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
