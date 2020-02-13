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
                <div class="form-group">
                  <label for="tipo_doc"><?= Yii::t('documento','Document type')?></label>
                  <?= Html::dropDownList(
                          'tipo_doc',
                          null,
                          ArrayHelper::map(
                                  TipoDocumento::find()
                                      ->select(['id_tipod','concat(abrv_tipod," - ",des_tipod) des_tipod'])
                                      ->where([
                                              'id_tipod' => [Documento::TIPODOC_FACTURA,Documento::TIPODOC_BOLETA ]
                                      ])->all(), 'id_tipod', 'des_tipod'),
                          [
                                  'prompt' => Yii::t('app','Select'),
                                  'class' => 'form-control',
                                  'id' => 'tipo_doc'
                          ]
                      ) ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
              <div class="form-group">
                <label for="serie_doc"><?= Yii::t('documento','Serie')?></label>
                <?= Html::dropDownList(
                    'serie_doc',
                    null,
                    [],
                    [
                        'prompt' => Yii::t('app','Select'),
                        'class' => 'form-control',
                        'id' => 'serie_doc'
                    ]
                ) ?>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="num_doc"><?= Yii::t('documento','Code')?></label>
                <?= Html::input('text', 'cod_doc', '', ['id' => 'cod_doc','class' => 'form-control', 'style' => ['text-align' => 'right'], 'maxlength' => 10])  ?>
              </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label></label>
                <button id="search"  class="btn btn-flat btn-success" style="width:100%"><?= Yii::t('app','Search');?>&nbsp; &nbsp;<i class="fa fa-search"></i></button>
            </div>

        </div>
    </div>
</div>
<?php

$js = '
   $( "#tipo_doc" ).on("change", function(){
        $.ajax({
            url:"' . Url::to(['numeracion/ajax-get-numeracion']) . '",
            data:{ id: $( this ).val()},
            method: "GET",
            success: function(data){
              $("#serie_doc").empty();
              let $option = $("<option />", {
                text: "Seleccione",
                value: "",
              });
              $("#serie_doc").prepend($option);
              $.each(data,function(i,value){
                $("#serie_doc").append($("<option></option>")
                    .attr("value",value.id_num)
                    .text(value.serie_num));
              });
            }
        });
   });

   $( "#cod_doc" ).on( "blur", function() {
     let value = $(this).val();


     if ( value && !isNaN( value ) ) {
        return $( this ).val( value.padStart( 10, "0") );
     }

     return $( this ).val();
   });

   $( "#search" ).on( "click", function() {
     $("#tipo_doc").parent().removeClass("has-error");
     $("#serie_doc").parent().removeClass("has-error");
     $("#cod_doc").parent().removeClass("has-error");


     if ( !$("#tipo_doc").val() ) {
        swal("Error","Oops, debe seleccionar un tipo de documento","error");
        $("#tipo_doc").parent().addClass("has-error");
        $("#tipo_doc").focus();
        return;
     }

     if ( !$("#serie_doc").val() ) {
        swal("Error","Oops, debe seleccionar la serie","error");
        $("#serie_doc").parent().addClass("has-error");
        $("#serie_doc").focus();
        return;
     }

     if ( !$("#cod_doc").val() ) {
        swal("Error","Oops, debe indicar el numero de documento","error");
        $("#cod_doc").parent().addClass("has-error");
        $("#cod_doc").focus();
        return;
     }

     $.ajax({
       url  : "'. Url::to(['documento/get-documento']).'",
       data : {
                tipo   : $("#tipo_doc").val(),
                serie  : $("#serie_doc").val(),
                numero : $("#cod_doc").val(),
              },
        success : function( data ) {

        },
        error   : function( data ) {
          swal("Error","Oops, there was an error","error");
          console.log(data);
        }
     });
   })
';

$this->registerJs($js,View::POS_END);
