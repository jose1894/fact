<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */

$this->title = Yii::t('documento', 'Update Documento: {name}', [
    'name' => $model->id_doc,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('documento', 'Documentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_doc, 'url' => ['view', 'id' => $model->id_doc]];
$this->params['breadcrumbs'][] = Yii::t('documento', 'Update');
?>
<div class="documento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
