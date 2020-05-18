<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_tpdcto') ?>

    <?= $form->field($model, 'desc_tpdcto') ?>

    <?= $form->field($model, 'status_tpdcto') ?>

    <?= $form->field($model, 'sucursal_tpdcto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_producto', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tipo_producto', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
