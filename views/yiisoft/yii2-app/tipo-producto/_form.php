<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProducto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'desc_tpdcto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_tpdcto')->textInput() ?>

    <?= $form->field($model, 'sucursal_tpdcto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_producto', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
