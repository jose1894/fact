<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use app\models\SucursalSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('empresa', 'View company: {name}', [
    'name' => $model->nombre_empresa,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('empresa', 'Company'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empresa-view">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= Html::encode($this->title) ?>
      </h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
              <p>
                  <?= Html::a(Yii::t('empresa', 'Update'), ['update', 'id' => $model->id_empresa, 'asDialog' => 1], ['class' => 'btn btn-primary']) ?>
                  <?= Html::a(Yii::t('empresa', 'Delete'), ['delete', 'id' => $model->id_empresa], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => Yii::t('empresa', 'Are you sure you want to delete this item?'),
                          'method' => 'post',
                      ],
                  ]) ?>
              </p>

              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                      'id_empresa',
                      'nombre_empresa',
                      [
                        'attribute' => 'estatus_empresa',
                        'format' => 'raw',
                        'value' => $model->estatus_empresa ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                      ],
                      'dni_empresa',
                      'ruc_empresa',
                      [
                         'attribute'=>'tipopers_empresa',
                         //'label'=>'Available?',
                         'format'=>'raw',
                         'value'=> (($model->tipopers_empresa == 1) ? 'Registro único de contribuyente (RUC)' : (($model->tipopers_empresa == 2) ? 'Documento nacional de identificación (DNI)':(($model->tipopers_empresa == 3) ? 'Pasaporte' : 'Carnet de extranjería'))).'<span class="label label-success"></span>',
                         'valueColOptions'=>['style'=>'width:30%']
                     ],
                      'tlf_empresa',
                      'direcc_empresa:ntext',
                  ],
              ]) ?>
              <h3><?= Yii::t('sucursal', 'Branch offices')?> </h3>
              <hr>
              <?php
              $sucursales = new SucursalSearch;
              $dataProvider = $sucursales->search([ "empresa_suc" => $model->id_empresa ]);

              echo  GridView::widget([
                  'dataProvider' => $dataProvider,
                  'summary' => '',
                  'columns' => [
                      //['class' => 'yii\grid\SerialColumn'],
                      [
                        'attribute'=>'id_suc',
                        'width' => '5%'
                      ],
                      [
                        'attribute' => 'nombre_suc',
                      ],
                      [
                          'class' => 'kartik\grid\BooleanColumn',
                          'attribute' => 'estatus_suc',
                          'vAlign' => 'middle',
                          'width' => '10%'
                      ],

                    ],

              ]);

              ?>
            </div>
      </div>
      <!-- /.box-body -->
  </div>
</div>
