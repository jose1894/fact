<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ZonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zona-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_zona') ?>

    <?= $form->field($model, 'nombre_zona') ?>

    <?= $form->field($model, 'desc_zona') ?>

    <?= $form->field($model, 'estatus_zona') ?>

    <?= $form->field($model, 'sucursal_zona') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('zona', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('zona', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
