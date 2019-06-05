<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoDetalleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-detalle-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_pdetalle') ?>

    <?= $form->field($model, 'prod_pdetalle') ?>

    <?= $form->field($model, 'cant_pdetalle') ?>

    <?= $form->field($model, 'precio_pdetalle') ?>

    <?= $form->field($model, 'descu_pdetalle') ?>

    <?php // echo $form->field($model, 'impuesto_pdetalle') ?>

    <?php // echo $form->field($model, 'status_pdetalle') ?>

    <?php // echo $form->field($model, 'pedido_pdetalle') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('pedido', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('pedido', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
