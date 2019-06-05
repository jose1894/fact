<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlmacenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="almacen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_almacen') ?>

    <?= $form->field($model, 'des_almacen') ?>

    <?= $form->field($model, 'status_almacen') ?>

    <?= $form->field($model, 'sucursal_almacen') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('almacen', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('almacen', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
