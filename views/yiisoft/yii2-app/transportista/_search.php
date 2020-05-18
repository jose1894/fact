<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransportistaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transportista-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_transp') ?>

    <?= $form->field($model, 'des_transp') ?>

    <?= $form->field($model, 'status_transp') ?>

    <?= $form->field($model, 'sucursal_transp') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('transportista', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('transportista', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
