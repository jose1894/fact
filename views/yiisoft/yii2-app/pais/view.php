<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pais */

$this->title = Yii::t('pais','Country: <span class="label label-primary">{number}</span> {name}',[ 'number' => $model->id_pais, 'name' => $model->des_pais]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('pais', 'Country: <span class="label label-primary">{number}</span> {name}',
    [ 'number' => $model->id_pais,
     'name' => $model->des_pais]), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pais-view">
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
                    'id_pais',
                    'cod_pais',
                    'des_pais',
                    [
                        'attribute' => 'status_pais',
                        'format' => 'raw',
                        'value' => $model->status_pais ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                      ],
                    //'sucursal_pais',
                ],
            ]) ?>
        </div>
    </div>

</div>
</div>
