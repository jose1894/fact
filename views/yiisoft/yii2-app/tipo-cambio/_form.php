<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Moneda;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCambio */
/* @var $form yii\widgets\ActiveForm */
$model->fecha_tipoc =  date('d/m/Y');
?>

<div class="tipo-cambio-form">

  <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>

  <div class="row">
    <div class=" col-xs-12">
      <?= $form->field($model, 'fecha_tipoc',[
        'addClass' => 'form-control ',
        ])->widget(DatePicker::classname(), [
          'options' => ['placeholder' => 'Enter birth date ...', 'style' => 'width:100%'],
          'pluginOptions' => [
              'autoclose'=>true
          ],
          'disabled' => true,
        ]); ?>
    </div>
    <div class="col-xs-12">
        <?= $form->field($model, 'cambioc_tipoc',
            [ 'addClass' => 'form-control number-decimals3']
        )->textInput([ 'type'=>'text'])?>
    </div>
    <div class="col-xs-12">
        <?= $form->field($model, 'valorf_tipoc',
            [ 'addClass' => 'form-control number-decimals3']
        )->textInput([ 'type'=>'text']) ?>
    </div>

    <div class="col-xs-12">
      <?= $form->field($model, 'venta_tipoc',
          [ 'addClass' => 'form-control number-decimals3']
      )->textInput([ 'type'=>'text']) ?>
    </div>


  </div>
    <!--div class="form-group">
        <?= Html::submitButton(Yii::t('tipo_cambio', 'Save'), ['class' => 'btn btn-success']) ?>
    </div-->

    <?php ActiveForm::end(); ?>

</div>
