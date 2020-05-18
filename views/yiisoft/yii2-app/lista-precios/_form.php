<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListaPrecios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lista-precios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_lista')->textInput() ?>

    <?= $form->field($model, 'prod_lista')->textInput() ?>

    <?= $form->field($model, 'precio_lista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sucursal_lista')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lista_precios', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
