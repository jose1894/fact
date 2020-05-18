<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NumeracionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="numeracion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_num') ?>

    <?= $form->field($model, 'tipo_num') ?>

    <?= $form->field($model, 'numero_num') ?>

    <?= $form->field($model, 'sucursal_num') ?>

    <?= $form->field($model, 'serie_num') ?>

    <?php // echo $form->field($model, 'status_num') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('numeracion', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('numeracion', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
