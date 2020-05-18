<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_clte') ?>

    <?= $form->field($model, 'dni_clte') ?>

    <?= $form->field($model, 'ruc_clte') ?>

    <?= $form->field($model, 'nombre_clte') ?>

    <?= $form->field($model, 'direcc_clte') ?>

    <?php // echo $form->field($model, 'depto_cte') ?>

    <?php // echo $form->field($model, 'provi_cte') ?>

    <?php // echo $form->field($model, 'dtto_clte') ?>

    <?php // echo $form->field($model, 'tlf_ctle') ?>

    <?php // echo $form->field($model, 'vendedor_clte') ?>

    <?php // echo $form->field($model, 'estatus_ctle') ?>

    <?php // echo $form->field($model, 'condp_clte') ?>

    <?php // echo $form->field($model, 'sucursal_clte') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cliente', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cliente', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
