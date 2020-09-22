<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MotivoNcredito */

$this->title = Yii::t('motivo_ncredito', 'Create Motivo Ncredito');
$this->params['breadcrumbs'][] = ['label' => Yii::t('motivo_ncredito', 'Motivo Ncreditos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motivo-ncredito-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
