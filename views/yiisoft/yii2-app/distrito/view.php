<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */

$this->title = Yii::t('distrito', 'District / Parish: <span class="label label-primary">{number}</span> {name}',[
  'number' => $model->id_dtto,
  'name' => $model->des_dtto
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('distrito', 'Distritos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="distrito-view">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?= $this->title ?>
      </h3>
    </div>
    <div class="box-body">
      <div class="container-fluid">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id_dtto',
              'des_dtto',
              [
                'attribute' => 'pais_dtto',
                'value' => $model->paisDtto->des_pais
              ],
              [
                'attribute' => 'prov_dtto',
                'value' => $model->provDtto->des_prov
              ],
              [
                'attribute' => 'depto_dtto',
                'value' => $model->deptoDtto->des_depto
              ],
              [
                'attribute' => 'status_dtto',
                'format' => 'raw',
                'value' => $model->status_dtto ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
              ],
          ],
      ]) ?>
      </div>
    </div>
  </div>
</div>
