<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_empresa') ?>

    <?= $form->field($model, 'nombre_empresa') ?>

    <?= $form->field($model, 'estatus_empresa') ?>

    <?= $form->field($model, 'dni_empresa') ?>

    <?= $form->field($model, 'ruc_empresa') ?>

    <?php // echo $form->field($model, 'tipopers_empresa') ?>

    <?php // echo $form->field($model, 'tlf_empresa') ?>

    <?php // echo $form->field($model, 'direcc_empresa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('empresa', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('empresa', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
