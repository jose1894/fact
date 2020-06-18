<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use app\models\TipoDocumento;
use yii\web\View ;

/* @var $this yii\web\View */
/* @var $model app\models\Numeracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="numeracion-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?php
          $mov = TipoDocumento::getTipoDocumentoList( );
        ?>
        <?= $form->field($model, 'tipo_num',[
            'addClass' => 'form-control'
          ])->widget(Select2::classname(), [
                    'data' => $mov,
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-exchange"></i>']],
                    'options' => ['placeholder' => Yii::t('tipo_documento','Select a type').'...'],
                    'theme' => Select2::THEME_DEFAULT,
                    // 'pluginOptions' => [
                    //     'allowClear' => true
                    // ],
            ]) ?>
      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'serie_num')->textInput(['maxlength' => true]) ?>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'numero_num',[
          'addClass' => 'form-control',
          'addon' => ['prepend' => ['content'=>'#']]
          ])->textInput([
            'maxlength' => true,
            'placeholder' => '00000000000'

            ]) ?>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    		<?= $form->field($model, 'status_num',[
          		'addClass' => 'form-control ',
          		'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]])->dropDownList(
          		[1 => 'Activo', 0 => 'Inactivo'],
          		['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
    	</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$js = <<< JS
$( '#numeracion-serie_num' ).on( 'blur', function(){
  $( this ). val( $( this ).val().padStart(2,'0') );
})
$( '#numeracion-numero_num' ).on( 'blur', function(){
  $( this ). val( $( this ).val().padStart(10,'0') );
})
JS;
$this->registerJs($js,View::POS_LOAD);
