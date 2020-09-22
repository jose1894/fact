<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoNcreditoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motivo-ncredito-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_motivo') ?>

    <?= $form->field($model, 'cod_motivo') ?>

    <?= $form->field($model, 'des_motivo') ?>

    <?= $form->field($model, 'status_motivo') ?>

    <?= $form->field($model, 'sucursal_motivo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('motivo_ncredito', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('motivo_ncredito', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
