<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Numeracion */

$this->title = Yii::t('serie','Numeration: {number}',[ 'number' => $model->id_num]);;
$this->params['breadcrumbs'][] = ['label' => Yii::t('serie', 'Numeration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pais-view">
<div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">
        <h3><?= Html::encode($this->title) ?></h3>
      </h3>
    </div>
    <div class="box-body">
        <div class="container-fluid">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_num',
                'tipo_num',
                'serie_num',
                'numero_num',
                'sucursal_num',
                [
                    'attribute' => 'status_num',
                    'format' => 'raw',
                    'value' => $model->status_num ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'
                  ],
            ],
        ]) ?>
      </div>
    </div>

</div>
</div>
