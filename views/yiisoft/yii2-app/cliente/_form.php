<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Pais;
use app\models\Provincia;
use app\models\Departamento;
use app\models\Distrito;
use app\models\CondPago;
use app\models\Vendedor;
use app\models\TipoListap;
use app\models\TipoIdentificacion;
use yii\web\View ;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
 // or kartik\widgets\ActiveForm
/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">
  <div class="container-fluid">

    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'enableClientScript' => true]); ?>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <?php
            $tipoid = TipoIdentificacion::getTipoIdList();
          ?>
          <?= $form->field($model, 'tipoid_clte',[
            'addClass' => 'form-control'
            ])->widget(Select2::classname(), [
                      'data' => $tipoid,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                      'options' => ['placeholder' => Yii::t('pais','Select a id type').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      'pluginOptions' => [
                          'allowClear' => true
                      ],
              ]) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'dni_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']]
        ])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'ruc_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-tag"></i>']]
        ])->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <?= $form->field($model, 'nombre_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-pencil-square-o"></i>']]
        ])->textInput(['maxlength' => true,'placeholder' => Yii::t('cliente','Input a name')]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?= $form->field($model, 'direcc_clte',[
          'addClass' => 'form-control ',
          'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-file-text"></i>']]
        ])->textarea(['rows' => 6,'placeholder' => Yii::t('cliente','Input an address')]) ?>
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
          <?= $form->field($model, 'pais_cte',[
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
            echo Html::hiddenInput('cliente-selected_provincia', $model->provi_cte, ['id' => 'cliente-selected_provincia']);
          ?>
          <?= $form->field($model, 'provi_cte',[
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
                    'depends' => ['cliente-pais_cte'],
                    'url' => Url::to(['/provincia/provincias']),
                    'loadingText' => Yii::t('provincia','Loading provinces').'...',
                    'params' => ['cliente-selected_provincia']
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
        echo Html::hiddenInput('cliente-selected_depatamento', $model->depto_cte, ['id' => 'cliente-selected_depatamento']);
        ?>
        <?= $form->field($model, 'depto_cte',[
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
                  'depends' => ['cliente-provi_cte'],
                  'initDepends' => ['pais_cte'],
                  'url' => Url::to(['/departamento/departamentos']),
                  'loadingText' => Yii::t('departamento','Loading departments').'...',
                  'params' => ['cliente-selected_depatamento']
              ]
          ])?>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php
            $dttos = Distrito::find()->where(['status_dtto' => 1])
            ->orderBy('des_dtto')
            ->all();
            $dttos = ArrayHelper::map($dttos,'id_dtto','des_dtto');
            echo Html::hiddenInput('cliente-selected_distrito', $model->dtto_clte, ['id' => 'cliente-selected_distrito']);
          ?>
          <?= $form->field($model, 'dtto_clte',[
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
                    'depends' => ['cliente-depto_cte'],
                    'initDepends' => ['pais_dtto'],
                    'url' => Url::to(['/distrito/distritos']),
                    'loadingText' => Yii::t('departamento','Loading districts').'...',
                    'params' => ['cliente-selected_distrito']
                ]
            ]) ?>
      </div>
    </div>


    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'tlf_ctle',[
              'addClass' => 'form-control ',
              'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-phone"></i>']]
            ])->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <?php
            $vendedores = Vendedor::find()->where(['estatus_vend' => 1])
            ->orderBy('nombre_vend')
            ->all();
            $vendedores=ArrayHelper::map($vendedores,'id_vendedor','nombre_vend');
          ?>
          <?= $form->field($model, 'vendedor_clte',[
            'addClass' => 'form-control'
            ])->widget(Select2::classname(), [
                      'data' => $vendedores,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                      'options' => ['placeholder' => Yii::t('vendedor','Select a seller').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      'pluginOptions' => [
                          'allowClear' => true
                      ],
              ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?php
            $tipolista = TipoListap::find()->where(['estatus_lista' => 1])
            ->orderBy('desc_lista')
            ->all();
            $tipolista=ArrayHelper::map($tipolista,'id_lista','desc_lista');
          ?>
            <?= $form->field($model, 'lista_clte',[
            'addClass' => 'form-control ',
            'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']]
            ])->dropDownList(
              $tipolista,
              ['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'estatus_ctle',[
            'addClass' => 'form-control ',
            'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-ticket"></i>']]
            ])->dropDownList(
              [1 => 'Activo', 0 => 'Inactivo'],
              ['custom' => true, 'prompt' => Yii::t('app','Select...')]) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <?php
            $condiciones = CondPago::find()->where(['status_condp' => 1])
            ->orderBy('desc_condp')
            ->all();
            $condiciones=ArrayHelper::map($condiciones,'id_condp','desc_condp');
          ?>
          <?= $form->field($model, 'condp_clte',[
            'addClass' => 'form-control'
            ])->widget(Select2::classname(), [
                      'data' => $condiciones,
                      'language' => Yii::$app->language,
                      'addon' => [ 'prepend' => ['content'=>'<i class="fa fa-check"></i>']],
                      'options' => ['placeholder' => Yii::t('condicionp','Select a payment condition').'...'],
                      'theme' => Select2::THEME_DEFAULT,
                      'pluginOptions' => [
                          'allowClear' => true
                      ],
              ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

  </div>
</div>
