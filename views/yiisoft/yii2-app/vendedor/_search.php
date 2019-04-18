<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VendedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_vendedor') ?>

    <?= $form->field($model, 'dni_vend') ?>

    <?= $form->field($model, 'nombre_vend') ?>

    <?= $form->field($model, 'tlf_vend') ?>

    <?= $form->field($model, 'estatus_vend') ?>

    <?php // echo $form->field($model, 'sucursal_vend') ?>

    <?php // echo $form->field($model, 'zona_vend') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('vendedor', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('vendedor', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
