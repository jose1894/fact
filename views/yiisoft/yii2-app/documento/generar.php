<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('documento', 'Generate invoice').'s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!-- Pedidos -->
    <iframe id="frame-pedido" src="<?= Url::to(['pedido/pendiente'])?>" width="100%" height="700px" >
    </iframe>
  </div><!-- Fin pedidos -->
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><!-- Guias -->
    <iframe id="frame-guia" src="" width="100%" style="position: absolute; height: 100%;" >
    </iframe>
  </div><!-- Fin Guias -->
</div>
