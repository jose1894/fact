<?php
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Producto;
use app\models\TipoProducto;
use app\models\Marca;
use kartik\grid\GridView;
use app\models\TipoListap;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ListaPreciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lista_precios', 'Lista Precios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lista-precios-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <br>
    <div class="row">
      <?php $form = ActiveForm::begin([ 'id' => "update-form", 'enableClientScript' => true]); ?>
      <div class="col-lg-3">
        <label for=""><?= Yii::t('lista_precios', 'Mode')?></label>
        <?php $items = [ Yii::t('lista_precios', 'Percentage') . " % ", Yii::t('lista_precios', 'Valor')]?>
        <?= Html::radioList('modalidad', null, $items, ['separator'=>"&nbsp; &nbsp;",'encode'=>false]); ?>
      </div>
      <div class="col-lg-3">
        <label for=""><?= Yii::t('lista_precios', 'Operator')?></label>
        <?php $items = [ '+' => Yii::t('lista_precios', 'Increase') . " (+) ", '-' => Yii::t('lista_precios', 'Discount') . " (-) "]?>
        <?= Html::radioList('operador', null, $items, ['separator'=>"&nbsp;",'encode'=>false]); ?>
      </div>
      <div class="col-lg-3">
        <label for="actualizar-precio">Valor</label>
        <?= Html::input('text', 'actualizar-precio', '' ,['id'=>'actualizar-precio','class' => 'form-control number-decimals']); ?>
      </div>
      <div class="col-lg-3">
        <?= Html::button('Actualizar', ['id'=>'update','class' => 'btn btn-flat btn-success']); ?>
      </div>
    <?php ActiveForm::end();?>
    </div>
    <br>
    <br>
    <?php Pjax::begin(['id' => 'grid', 'timeout' => 3000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'toolbar' => [
            [
                'content'=> '',
            ],
            // '{export}',
            '{toggleData}'
        ],
        'panel' => [
          'heading'=>'<h3 class="panel-title"><i class="fa fa-book"></i> ' . Yii::t('lista_precios','List prices') . '</h3>',
        ],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            ['class' => 'kartik\grid\CheckboxColumn',
            'checkboxOptions' => function ($dataProvider, $key, $index, $column) {

                return ['value' => $dataProvider->id_lista.'*'.$dataProvider->precio_lista, 'id' => 'check-'.$key];   }
            ],
            [
              'attribute' => 'tipo_prod',
              'value' => 'prodLista.tipoProd.desc_tpdcto',
              'label' => Yii::t('tipo_producto', 'Product type'),
              'filter'=> TipoProducto::getTipoProductoList(),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
            ],
            [
              'attribute' => 'codigo',
              'value' => 'prodLista.cod_prod',
              'label' => Yii::t('producto', 'Code')
            ],
            [
                'attribute' => 'descripcion',
                'label' => Yii::t('producto', 'Description'),
                'value' => 'prodLista.des_prod',
                'filter'=>Producto::getProductoList(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'language' => Yii::$app->language,
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => ['allowClear' => true],
                    'pluginEvents' =>[],
                    'options' => ['prompt' => ''],
                ],
                //'width' => '20%'
            ],
            [
              'attribute' => 'marca',
              'value' => 'prodLista.marca.desc_marca',
              'label' => Yii::t('marca', 'Make'),
              'filter'=> Marca::getMarcaList(),
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                  'language' => Yii::$app->language,
                  'theme' => Select2::THEME_DEFAULT,
                  'pluginOptions' => ['allowClear' => true],
                  'pluginEvents' =>[],
                  'options' => ['prompt' => ''],
              ],
            ],
            [
                'attribute'=> 'precio_lista',
                'value' => function($data){
                    $precio_lista = Yii::$app->formatter->asDecimal($data->precio_lista);
                    return $precio_lista;
                },
                //'value' => 'precio_lista',
                'width' => '10%'

            ],
            [
                'attribute'=>'tipo_lista',
                'value' => function($data){
                     return $data->tipoLista->desc_lista;
                },
                'filter'=>ArrayHelper::map(TipoListap::find()->where(['estatus_lista' => 1])->asArray()->all(), 'id_lista', 'desc_lista'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'language' => Yii::$app->language,
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => ['allowClear' => true],
                    'pluginEvents' =>[],
                    'options' => ['prompt' => ''],
                ],
                //'width' => '10%'
              ],
        ],
        'pjax'=>true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php
$js = "
$('#update').click(function(){
    if($('#actualizar-precio').val() == ''){
        swal('" . Yii::t('lista_precios', 'List prices') . "', 'You must set a new price amount', 'error');
        $('#actualizar-precio').focus();
        return
    } else {
        var keys = $('#w0').yiiGridView('getSelectedRows');
        if ( keys.length == 0) {
            swal('" . Yii::t('lista_precios', 'List prices') . "', 'You must select an item (s) from the list below!', 'error');
            return
        } else {
            swal({
              title: '" . Yii::t('lista_precios', 'Are you sure want to update the prices?') . "',
              icon: 'info',
              buttons: true,
              dangerMode: true,
            })
            .then((willIssue) => {
              if (willIssue) {
                  var valor = parseFloat($('#actualizar-precio').val());
                  var optionModalidad = +$('input[name=\"modalidad\"]:checked').val();
                  var operador = $('input[name=\"operador\"]:checked').val();

                  if (isNaN(optionModalidad)) {
                    swal('" . Yii::t('lista_precios', 'List prices') . "', '" . Yii::t('lista_precios', 'You must select a mode!') . "', 'error');
                    return;
                  }

                  if (typeof operador === 'undefined') {
                    swal('" . Yii::t('lista_precios', 'List prices') . "', '" . Yii::t('lista_precios', 'You must select a operator!') . "', 'error');
                    return;
                  }

                  var total = 0;
                  var dataPreciosAct = keys.map((idElement)=>{
                      var value = $('#check-'+idElement).val();
                      value = value.split('*');
                      var precio = parseFloat(value[1]);
                      var idLista = value[0];
                      if (!optionModalidad) {
                          total = calcularPorcentaje(precio,valor,operador);
                      } else {
                          if (operador === '+') {
                            total = precio + valor;
                          } else if ( operador === '-') {
                            total = precio - valor;
                          }
                      }
                      return {'idLista': idLista, 'precioActual': total}
                  })

                  $.post({
                      url: '". Url::to('lista-precios/update-lista-precios') ."',
                      dataType: 'json',
                      data: {dataPreciosAct}
                  }).done(function(data){
                      if (data.success) {
                          swal(data.title, data.message, data.type)
                          window.parent.$.pjax.reload('#grid', {timeout: 3000} );
                      }
                  });
                } else {
                  $('#actualizar-precio').val('');
                  $('input[name=\"modalidad\"]').prop('checked',false);
                  $('input[name=\"operador\"]').prop('checked',false);
                }
              });
        }
    }
});
/**evento para actualizar el precio cuando se escribe en el input*/
$('#actualizar-precio').on('keyup', function() {
    var valor = $(this).val();
    let operador = $('input[name=\"operador\"]:checked').val()

    if (valor !== '') {
        valor = Number(valor);
        if ($.isNumeric(valor)) {
            actualizarPrecioGrid(valor, operador);
        }
    }
});
/**Evento que se activa cuando se selecciona el check de procentaje*/
$('input[name=\"modalidad\"]').click(function(){
    var valor = parseFloat($('#actualizar-precio').val());
    let operador =$('input[name=\"operador\"]:checked').val();
    if( valor > 100){
        swal('" . Yii::t('lista_precios', 'List prices') . "', 'Percentage is greather tan 100%', 'error');
        $('input[name=\"modalidad\"]').prop('checked',false);
    } else {
        updateDataGrid(true, valor, operador);
    }
});

/**Métod que se activa cuando se escribe en el input para actualizar el precio*/
function actualizarPrecioGrid(valor, operador){
    var optionPorcentaje = +$('input[name=\"modalidad\"]:checked').val();
    updateDataGrid(optionPorcentaje, valor, operador);
}

/**Este metodo se utiliza cuando se escribe en el input y cuando se seleccion el check de porcentaje*/
function updateDataGrid(modalidad, valor, operador) {
    var total = 0;
    $('.table tr').each(function (i, row) {
        var actualrow = $(row);
        checkbox = actualrow.find('input').is(':checked');
        if(checkbox) { // si esta seleccionado el check de la fila
            var key = $(this).attr('data-key');
            var precioProd = getPrecioGrid(key);
            var currentRow = $(this).closest('tr');
            if(!modalidad) { // si esta seleccionado el check de aplciar porcentaje
                total = calcularPorcentaje(precioProd, valor, operador);
            } else {
                if (operador === '+') {
                  total = round(precioProd + valor);
                } else if (operador === '-') {
                  total = round(precioProd - valor);
                }

            }
            //actualizar fila de precio del producto
            currentRow.find('td:eq(5)').text(total);
         }
    });
}
/**Método que retorna el valor del precio,
 * para esto se toma lo que esta en la propiedad
 * value del check de cada fila del grid*/
function getPrecioGrid(key) {
    var value = $('#check-'+key).val();
    if(value) {
        value = value.split('*');
        return parseFloat(value[1]);
    }
}

/**Para calcular el porcentaje al precio */
function calcularPorcentaje(precio, porcentaje, operador){
    var precioPor = 0;

    if(porcentaje <= 100) {
          precioPor = ((precio * porcentaje)/100);
    }

    if (operador === '+') {
      return round( precio + precioPor );
    } else if (operador === '-') {
       return round( precio - precioPor );
    }

    return round(precio);
}
";
$this->registerJs($js,View::POS_LOAD);
