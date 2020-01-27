<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProvinciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provincia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_prov') ?>

    <?= $form->field($model, 'des_prov') ?>

    <?= $form->field($model, 'status_prov') ?>

    <?= $form->field($model, 'sucursal_prov') ?>

    <?= $form->field($model, 'pais_prov') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('provincia', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('provincia', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
