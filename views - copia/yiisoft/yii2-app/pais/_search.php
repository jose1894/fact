<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pais-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_pais') ?>

    <?= $form->field($model, 'cod_pais') ?>

    <?= $form->field($model, 'des_pais') ?>

    <?= $form->field($model, 'status_pais') ?>

    <?= $form->field($model, 'sucursal_pais') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('pais', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('pais', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
