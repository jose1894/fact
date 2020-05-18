<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProveedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_prove') ?>

    <?= $form->field($model, 'dni_prove') ?>

    <?= $form->field($model, 'ruc_prove') ?>

    <?= $form->field($model, 'nombre_prove') ?>

    <?= $form->field($model, 'direcc_prove') ?>

    <?php // echo $form->field($model, 'pais_prove') ?>

    <?php // echo $form->field($model, 'depto_prove') ?>

    <?php // echo $form->field($model, 'provi_prove') ?>

    <?php // echo $form->field($model, 'dtto_prove') ?>

    <?php // echo $form->field($model, 'tlf_prove') ?>

    <?php // echo $form->field($model, 'tipo_prove') ?>

    <?php // echo $form->field($model, 'status_prove') ?>

    <?php // echo $form->field($model, 'sucursal_prove') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('proveedor', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('proveedor', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
