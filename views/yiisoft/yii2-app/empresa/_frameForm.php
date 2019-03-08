<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use app\components\AutoIncrement;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
if ( $model->isNewRecord ) {
  $model->id_empresa = AutoIncrement::getAutoIncrement( 'empresa' );
}

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("'.Yii::t('sucursal','Branch office').': " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("'.Yii::t('sucursal','Branch office').': " + (index + 1))
    });
});

$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
  debugger;
  data  = {
          title: "'.Yii::t('empresa','Company').'",
          text: "'.Yii::t('sucursal','Are you sure to delete this Branch office?').'",
          icon: "warning",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "'.Yii::t('app','Confirm').'" ,
          showCancelButton: true,
          buttons: true,
          dangerMode: true,
      };

  // Show the user a swal confirmation window
  window.parent.swal( data ).
  then( (willdelete) => {
      if (willdelete) {
          // This function will run ONLY if the user clicked "ok"
          // Only here we want to send the request to the server!
          return true;
      }
      return false;
 });
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
';

$this->registerJs($js);
?>
<div class="empresa-form">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Yii::t('empresa','Create company')?></h3>
            </div>
            <div class="box-body">
                <div class="container-fluid">
                  <?php $form = ActiveForm::begin([ 'id' => $model->formName(), 'enableClientScript' => true,  ]); ?>

                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <?= $form->field($model, 'id_empresa',[
                        'addClass' => 'form-control input-sm',
                        'addon' => ['prepend'=>['content'=>"#"]],
                        ])->textInput(['readonly' => true]) ?>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                      <?= $form->field($model, 'nombre_empresa',[
                        'addClass' => 'form-control input-sm',
                        'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-trademark"></i>']]
                        ])->textInput(['maxlength' => true,'placeholder' => Yii::t('empresa','Input a name')."..."]) ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <?= $form->field($model, 'estatus_empresa',[
                        'addClass' => 'form-control input-sm'
                        ])->dropDownList(
                          [1 => 'Activo', 0 => 'Inactivo'],
                          ['custom' => true, 'prompt' => 'Select ...']) ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <?= $form->field($model, 'dni_empresa',[
                        'addClass' => 'form-control input-sm'
                        ])->widget('yii\widgets\MaskedInput', [
                              'mask' => '9999999999',
                              'options'=> [ 'class' => 'form-control input-sm']
                          ]) ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <?= $form->field($model, 'ruc_empresa',[
                        'addClass' => 'form-control input-sm'
                        ])->widget('yii\widgets\MaskedInput', [
                              'mask' => '99999999999',
                              'options'=> [ 'class' => 'form-control input-sm']
                          ]) ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <?= $form->field($model, 'tipopers_empresa',[
                        'addClass' => 'form-control input-sm'
                        ])->dropDownList(
                        [1 => 'Registro único de contribuyente (RUC)', 2 => 'Documento nacional de identificación (DNI)', 3 => 'Pasaporte', 4 => 'Carnet de extranjería'],
                        ['custom' => true, 'prompt' => 'Select ...']) ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <?= $form->field($model, 'tlf_empresa',[
                        'addClass' => 'form-control input-sm',
                        'addon' => ['prepend'=> ['content'=>'<i class="fa fa-phone"></i>']]
                        ])->textInput(['maxlength' => true,'placeholder' => Yii::t("empresa","Input a phone")."..."]) ?>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                        <?= $form->field($model, 'direcc_empresa',[
                          'addClass' => 'form-control input-sm'
                          ])->textarea(['rows' => 6,'placeholder' => Yii::t("empresa","Input an address")."..."]) ?>
                      </div>
                  </div>

                  <div class="row"><!--Sucursales -->
                    <div class="col-lg-12">
                              <?php DynamicFormWidget::begin([
                                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                    'widgetBody' => '.container-items', // required: css class selector
                                    'widgetItem' => '.item', // required: css class
                                    'limit' => 10, // the maximum times, an element can be cloned (default 999)
                                    'min' => 0, // 0 or 1 (default 1)
                                    'insertButton' => '.add-item', // css class
                                    'deleteButton' => '.remove-item', // css class
                                    'model' => $modelsSucursal[0],
                                    'formId' => $model->formName(),
                                    'formFields' => [
                                        'id_suc',
                                        'nombre_suc',
                                        'estatus_suc',
                                        'empresa_suc'
                                    ],
                                ]); ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <i class="fa fa-envelope"></i> <?= Yii::t('sucursal','Branch offices')?>
                                        <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> <?= Yii::t('sucursal','Add branch office')?></button>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body container-items"><!-- widgetContainer -->
                                        <?php foreach ($modelsSucursal as $index => $modelSucursal): ?>
                                            <div class="item panel panel-default"><!-- widgetBody -->
                                                <div class="panel-heading">
                                                    <span class="panel-title-address"><?= Yii::t('sucursal','Branch office')." : ". ($index + 1) ?></span>
                                                    <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="panel-body">
                                                    <?php
                                                        // necessary for update action.
                                                        if (!$modelSucursal->isNewRecord) {
                                                            echo Html::activeHiddenInput($modelSucursal, "[{$index}]id_suc");
                                                            //$modelSucursal->empresa_suc[$index] = $model->id_empresa;
                                                            echo Html::activeHiddenInput($modelSucursal, "[{$index}]empresa_suc");
                                                        }
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <?= $form->field($modelSucursal, "[{$index}]nombre_suc",[
                                                              'addClass' => 'form-control input-sm'
                                                              ])->textInput(['maxlength' => true]) ?>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <?= $form->field($modelSucursal, "[{$index}]estatus_suc",[
                                                              'addClass' => 'form-control input-sm'
                                                              ])->dropDownList([1 => 'Activo', 0 => 'Inactivo'], ['prompt' => 'Select..']) ?>
                                                        </div>
                                                    </div><!-- end:row -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php DynamicFormWidget::end(); ?>
                        </div>
                  </div><!--Sucursales-->



                  <!--div class="form-group">
                      <?php /* Html::submitButton(Yii::t('empresa', 'Save'), ['class' => 'btn btn-success'])*/ ?>
                  </div-->

                  <?php ActiveForm::end(); ?>

                </div>
          </div>
          <!-- /.box-body -->
        </div>
</div>
