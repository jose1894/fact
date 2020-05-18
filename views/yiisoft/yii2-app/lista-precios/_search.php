<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ListaPreciosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lista-precios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_lista') ?>

    <?= $form->field($model, 'tipo_lista') ?>

    <?= $form->field($model, 'prod_lista') ?>

    <?= $form->field($model, 'precio_lista') ?>

    <?= $form->field($model, 'sucursal_lista') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lista_precios', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('lista_precios', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
