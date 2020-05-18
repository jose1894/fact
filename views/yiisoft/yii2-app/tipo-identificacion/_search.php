<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoIdentificionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-identificacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_tipoi') ?>

    <?= $form->field($model, 'cod_tipoi') ?>

    <?= $form->field($model, 'des_tipoi') ?>

    <?= $form->field($model, 'status_tipoi') ?>

    <?= $form->field($model, 'sucursal_tipoi') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_identificacion', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tipo_identificacion', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
