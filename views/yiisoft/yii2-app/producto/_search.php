<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_prod') ?>

    <?= $form->field($model, 'cod_prod') ?>

    <?= $form->field($model, 'des_prod') ?>

    <?= $form->field($model, 'tipo_prod') ?>

    <?= $form->field($model, 'umed_prod') ?>

    <?php // echo $form->field($model, 'contenido_prod') ?>

    <?php // echo $form->field($model, 'exctoigv_prod') ?>

    <?php // echo $form->field($model, 'compra_prod') ?>

    <?php // echo $form->field($model, 'venta_prod') ?>

    <?php // echo $form->field($model, 'stockini_prod') ?>

    <?php // echo $form->field($model, 'stockmax_prod') ?>

    <?php // echo $form->field($model, 'stockmin_prod') ?>

    <?php // echo $form->field($model, 'status_prod') ?>

    <?php // echo $form->field($model, 'sucursal_prod') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('producto', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('producto', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
