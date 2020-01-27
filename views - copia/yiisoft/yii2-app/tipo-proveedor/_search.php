<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProveedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_tprov') ?>

    <?= $form->field($model, 'des_tprov') ?>

    <?= $form->field($model, 'status_tprov') ?>

    <?= $form->field($model, 'sucursal_tprov') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_proveedor', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tipo_proveedor', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
