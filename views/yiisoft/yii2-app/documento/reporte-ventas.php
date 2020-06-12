<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\web\View;
use kartik\grid\GridView;
use yii\web\JqueryAsset;
use app\models\Cliente;
use app\models\Pedido;
use app\models\Vendedor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = Yii::t('documento','Sales report');
$this->params['breadcrumbs'][] = $this->title;
?>
