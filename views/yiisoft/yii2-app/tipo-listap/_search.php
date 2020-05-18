<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoListapSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-listap-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_lista') ?>

    <?= $form->field($model, 'desc_lista') ?>

    <?= $form->field($model, 'estatus_lista') ?>

    <?= $form->field($model, 'sucursal_lista') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_listap', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tipo_listap', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
