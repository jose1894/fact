<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadMedidaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidad-medida-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_und') ?>

    <?= $form->field($model, 'des_und') ?>

    <?= $form->field($model, 'status_und') ?>

    <?= $form->field($model, 'sucursal_und') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('unidad_medida', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('unidad_medida', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
