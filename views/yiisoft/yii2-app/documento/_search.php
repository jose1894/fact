<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_doc') ?>

    <?= $form->field($model, 'cod_doc') ?>

    <?= $form->field($model, 'tipo_doc') ?>

    <?= $form->field($model, 'pedido_doc') ?>

    <?= $form->field($model, 'fecha_doc') ?>

    <?php // echo $form->field($model, 'obsv_doc') ?>

    <?php // echo $form->field($model, 'totalimp_doc') ?>

    <?php // echo $form->field($model, 'totaldsc_doc') ?>

    <?php // echo $form->field($model, 'total_doc') ?>

    <?php // echo $form->field($model, 'status_doc') ?>

    <?php // echo $form->field($model, 'sucursal_doc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('documento', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('documento', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
