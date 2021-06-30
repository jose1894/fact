<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use app\models\Empresa;
use app\models\Sucursal;
use app\models\Vendedor;
use yii\helpers\Url;
use kartik\checkbox\CheckboxX;


/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */

$user_id = (int) Yii::$app->request->get('user_id');

if ( $user_id !== 0 )  {
    $model->user_id = $user_id;
}
?>

<div class="profile-form">
    <div class="container-fluid">
    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <?= $form
              ->field($model, 'user_id',['addClass' => 'form-control '])
              ->textInput(['maxlength' => true,'readonly' => true, 'style' => ['text-align' => 'right']]) ?>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label for="username">Username</label>
                <?=  Html::input("text", "username",Yii::$app->user->identity->username,['readonly' => '', 'class' => 'form-control']); ?>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?php $empresas = Empresa::empresaList();?>
                <?= $form
                    ->field($model, 'empresa')
                    ->widget(Select2::classname(), [
                      'data' => $empresas,
                      'initValueText' => $model->empresa,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-industry"></i>']],
                      'options' => [
                        'placeholder' => Yii::t('empresa','Select a company').'...',
                      ],
                      'theme' => Select2::THEME_DEFAULT,
                      // 'pluginOptions' => [
                      //     'allowClear' => true
                      // ],
              ]) ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <?php
              //$sucursales = Sucursal::getSucursalesList( $model->empresa );
              echo Html::hiddenInput('profile-selected_empresa', $model->sucursal, ['id' => 'profile-selected_empresa']);
              ?>
              <?= $form->field($model, 'sucursal',[
                'addClass' => 'form-control'
                ])->widget(DepDrop::classname(), [
                    'options' => ['placeholder' => Yii::t('app','Select...')],
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => [
                        'language' => Yii::$app->language,
                        'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                        'theme' => Select2::THEME_DEFAULT,
                        'pluginOptions' => ['allowClear' => true],
                        'pluginEvents' =>[]
                    ],
                    'pluginOptions' => [
                        'initialize' => true,
                        'depends' => ['profile-empresa'],
                        'url' => Url::to(['/empresa/sucursales']),
                        'loadingText' => Yii::t('sucursal','Loading branch offices').'...',
                        'params' => ['profile-selected_empresa']
                    ]
                ])?>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label for="">Es vendedor</label>
                <?php echo $form->field($model, 'es_vendedor')->widget(CheckboxX::classname(), [
                    // 'initInputType' => CheckboxX::INPUT_CHECKBOX,
                    // 'autoLabel' => true,
                    'pluginOptions'=>['threeState'=>false]
                ])->label(false); ?>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?php $vendedores = Vendedor::getVendedoresList();?>
              <?= $form->field($model, 'vendedor',[
                'addClass' => 'form-control'
                ])->widget(Select2::classname(), [
                    'data' => $vendedores,
                    'initValueText' => $model->vendedor,
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-user"></i>']],
                    'options' => [
                      'placeholder' => Yii::t('empresa','Select').'...',                      
                    ],
                    'theme' => Select2::THEME_DEFAULT,
                    // 'pluginOptions' => [
                    //     'allowClear' => true
                    // ],
            ])?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('profile', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$js = <<< JS

$( "#profile-es_vendedor" ).change(function(){    
    debugger;
    $( "#profile-vendedor" ).attr("disabled", this.checked);
});
JS;