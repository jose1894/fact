<?php

use app\models\TipoProveedor;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use app\models\Provincia;
use app\models\Departamento;
use app\models\Distrito;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>

    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'dni_prove',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']]
        ])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'ruc_prove',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']]
        ])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'nombre_prove',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]
        ])->textInput(['maxlength' => true,'placeholder' => Yii::t('proveedor','Input a name')]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?= $form->field($model, 'direcc_prove',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-file-text"></i>']]
        ])->textarea(['rows' => 6,'placeholder' => Yii::t('proveedor','Input an address')]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php
            $paises = Pais::find()->where(['status_pais' => 1])
            ->orderBy('des_pais')
            ->all();
            $paises=ArrayHelper::map($paises,'id_pais','des_pais');
          ?>
          <?= $form->field($model, 'pais_prove',[
            'addClass' => 'form-control'
            ])->widget(Select2::classname(), [
                      'data' => $paises,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                      'options' => ['placeholder' => Yii::t('pais','Select a country').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      'pluginOptions' => [
                          'allowClear' => true
                      ],
              ]) ?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php
            $provs = Provincia::find()->where(['status_prov' => 1])
            ->orderBy('des_prov')
            ->all();
            $provs = ArrayHelper::map($provs,'id_prov','des_prov');
            echo Html::hiddenInput('proveedor-selected_provincia', $model->provi_prove, ['id' => 'proveedor-selected_provincia']);
          ?>
          <?= $form->field($model, 'provi_prove',[
            'addClass' => 'form-control'
            ])->widget(DepDrop::classname(), [
                'options' => ['placeholder' => Yii::t('app','Select...')],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => [
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                    'options' => ['placeholder' => Yii::t('app','Select')],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => ['allowClear' => true],
                    'pluginEvents' =>[]
                ],
                'pluginOptions' => [
                    'initialize' => true,
                    'depends' => ['proveedor-pais_prove'],
                    'url' => Url::to(['/provincia/provincias']),
                    'loadingText' => Yii::t('provincia','Loading provinces').'...',
                    'params' => ['proveedor-selected_provincia']
                ]
            ]) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php
        $provs = Departamento::find()->where(['status_depto' => 1])
        ->orderBy('des_depto')
        ->all();
        $deptos = ArrayHelper::map($provs,'id_depto','des_depto');
        echo Html::hiddenInput('proveedor-selected_depatamento', $model->depto_prove, ['id' => 'proveedor-selected_depatamento']);
        ?>
        <?= $form->field($model, 'depto_prove',[
          'addClass' => 'form-control'
          ])->widget(DepDrop::classname(), [
              'options' => ['placeholder' => Yii::t('app','Select...')],
              'type' => DepDrop::TYPE_SELECT2,
              'select2Options' => [
                  'language' => Yii::$app->language,
                  'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                  'options' => ['placeholder' => Yii::t('app','Select')],
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[]
              ],
              'pluginOptions' => [
                  'initialize' => true,
                  'depends' => ['proveedor-provi_prove'],
                  'initDepends' => ['pais_prove'],
                  'url' => Url::to(['/departamento/departamentos']),
                  'loadingText' => Yii::t('departamento','Loading departments').'...',
                  'params' => ['proveedor-selected_depatamento']
              ]
          ])?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php
            $dttos = Distrito::find()->where(['status_dtto' => 1])
            ->orderBy('des_dtto')
            ->all();
            $dttos = ArrayHelper::map($dttos,'id_dtto','des_dtto');
            echo Html::hiddenInput('proveedor-selected_distrito', $model->dtto_prove, ['id' => 'proveedor-selected_distrito']);
          ?>
          <?= $form->field($model, 'dtto_prove',[
            'addClass' => 'form-control'
            ])->widget(DepDrop::classname(), [
                'options' => ['placeholder' => Yii::t('app','Select...')],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => [
                    'language' => Yii::$app->language,
                    'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                    'options' => ['placeholder' => Yii::t('app','Select')],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => ['allowClear' => true],
                    'pluginEvents' =>[]
                ],
                'pluginOptions' => [
                    'initialize' => true,
                    'depends' => ['proveedor-depto_prove'],
                    'initDepends' => ['pais_dtto'],
                    'url' => Url::to(['/distrito/distritos']),
                    'loadingText' => Yii::t('departamento','Loading districts').'...',
                    'params' => ['proveedor-selected_distrito']
                ]
            ]) ?>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'tlf_prove',[
              'addClass' => 'form-control ',
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-phone"></i>']]
            ])->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?php
            $tipoProve = TipoProveedor::getTipoProveedor();
            echo $form->field($model, 'tipo_prove',[
                'addClass' => 'form-control'
            ])->dropDownList(
                    $tipoProve,
                    [
                            'custom' => true,
                            'prompt' => Yii::t('app','Select...'),
                    ])?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'status_prove',[
            'addClass' => 'form-control ',
            'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]
            ])->dropDownList(
              [1 => 'Activo', 0 => 'Inactivo'],
              ['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
