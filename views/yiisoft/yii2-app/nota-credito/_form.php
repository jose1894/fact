<?php

use app\models\TipoDocumento;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cliente;
use app\models\Documento;
use app\models\Vendedor;
use app\models\Moneda;
use app\models\Almacen;
use app\models\CondPago;
use app\models\Producto;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\form\ActiveField;
use yii\web\View ;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use app\base\Model;
/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="documento-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label for="tipo_doc"><?= Yii::t('documento','Document type')?></label>
                <?= Html::dropDownList(
                        'tipo_doc',
                        null,
                        ArrayHelper::map(
                                TipoDocumento::find()
                                    ->select(['abrv_tipod','concat(abrv_tipod," - ",des_tipod) des_tipod'])
                                    ->where([
                                            'id_tipod' => [Documento::TIPODOC_FACTURA,Documento::TIPODOC_BOLETA ]
                                    ])->all(), 'abrv_tipod', 'des_tipod'),
                        [
                                'prompt' => Yii::t('app','Select'),
                                'class' => 'form-control',
                                'id' => 'tipo_doc'
                        ]
                    ) ?>
            </div>
        </div>
    </div>
</div>
<?php

$js = '
   $( "#tipo_doc" ).on("change", function(){
        $.ajax({
            url:"' . Url::to(['numeracion/ajax-get-numeracion']) . '",
            data:{ tipo: $( this ).val()},
            method: "GET",
            success: function(data){
                console.log(data);
            }
        })
   })
';

$this->registerJs($js,View::POS_END);