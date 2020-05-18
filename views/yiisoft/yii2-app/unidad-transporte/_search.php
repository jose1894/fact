<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadTransporteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidad-transporte-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_utransp') ?>

    <?= $form->field($model, 'des_utransp') ?>

    <?= $form->field($model, 'status_utransp') ?>

    <?= $form->field($model, 'sucursal_utransp') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('unidad_transporte', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('unidad_transporte', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
