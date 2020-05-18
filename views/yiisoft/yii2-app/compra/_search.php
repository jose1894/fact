<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_compra') ?>

    <?= $form->field($model, 'cod_compra') ?>

    <?= $form->field($model, 'fecha_compra') ?>

    <?= $form->field($model, 'provee_compra') ?>

    <?= $form->field($model, 'moneda_compra') ?>

    <?php // echo $form->field($model, 'condp_compra') ?>

    <?php // echo $form->field($model, 'usuario_compra') ?>

    <?php // echo $form->field($model, 'estatus_compra') ?>

    <?php // echo $form->field($model, 'edicion_compra') ?>

    <?php // echo $form->field($model, 'nrodoc_compra') ?>

    <?php // echo $form->field($model, 'sucursal_compra') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('compra', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('compra', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
