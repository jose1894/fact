<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoMovimientoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-movimiento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_tipom') ?>

    <?= $form->field($model, 'des_tipom') ?>

    <?= $form->field($model, 'status_tipom') ?>

    <?= $form->field($model, 'sucursal_tipom') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_movimiento', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tipo_movimiento', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
