<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_pedido') ?>

    <?= $form->field($model, 'cod_pedido') ?>

    <?= $form->field($model, 'fecha_pedido') ?>

    <?= $form->field($model, 'clte_pedido') ?>

    <?= $form->field($model, 'vend_pedido') ?>

    <?php // echo $form->field($model, 'moneda_pedido') ?>

    <?php // echo $form->field($model, 'almacen_pedido') ?>

    <?php // echo $form->field($model, 'usuario_pedido') ?>

    <?php // echo $form->field($model, 'estatus_pedido') ?>

    <?php // echo $form->field($model, 'sucursal_pedido') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('pedido', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('pedido', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
