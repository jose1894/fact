<?php
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Producto;
use kartik\grid\GridView;
use app\models\TipoListap;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ListaPreciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('lista_precios', 'Lista Precios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lista-precios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= Html::input('text', 'actualizar-precio', '' ,['id'=>'actualizar-precio','class' => 'number-decimals']) ?>
    <?= Html::checkbox('porcentaje', false, ['label' => 'Porcentaje', 'id'=>'check-porcentaje']) ?>
    <?= Html::button('Actualizar', ['id'=>'update','class' => 'btn btn-flat btn-success']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],            
            ['class' => 'kartik\grid\CheckboxColumn',
            'checkboxOptions' => function ($dataProvider, $key, $index, $column) {
                return ['value' => $dataProvider->id_lista.'*'.$dataProvider->precio_lista, 'id' => 'check-'.$key];   }
            ],
            [
                'attribute' => 'descripcion',
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
                'attribute'=> 'precio_lista',
                'value' => 'precio_lista',
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
        alert('Debe colocar el nuevo precio');
        $('#actualizar-precio').setfocus();
    } else {
        var keys = $('#w0').yiiGridView('getSelectedRows');
        if ( keys.length == 0) {
            alert('Debe seleccionar la lista de precio que desea actualizar')
        } else {
            var opcion = confirm('Desea actualizar el precio?');
            if (opcion == true) {            
                var incremento = parseFloat($('#actualizar-precio').val());
                var optionPorcentaje = $('#check-porcentaje').prop('checked');
                var total = 0;
                var dataPreciosAct = keys.map((idElement)=>{
                    var value = $('#check-'+idElement).val();
                    value = value.split('*');
                    var precio = parseFloat(value[1]);
                    var idLista = value[0];
                    if (optionPorcentaje) {
                        total = calcularPorcentaje(precio,incremento);
                    } else {
                        total = precio + incremento;
                    }
                    return {'idLista': idLista, 'precioActual': total}
                })
                $.post({
                    url: '". Url::to('lista-precios/update-lista-precios') ."',
                    dataType: 'json',
                    data: {dataPreciosAct}
                }).done(function(data){
                    if (data.success) {
                        window.parent.$.pjax.reload('#w0', {timeout: 3000} );
                    }
                });
            } else {
                $('#actualizar-precio').val('');
                $('#check-porcentaje').prop('checked',false);
            }
        }        
    }
});
/**evento para actualizar el precio cuando se escribe en el input*/
$('#actualizar-precio').on('keyup', function() {
    var incremento = $(this).val();   
    if (incremento !== '') {
        incremento = Number(incremento);
        if ($.isNumeric(incremento)) {
            actualizarPrecioGrid(incremento);
        }
    }    
});
/**Evento que se activa cuando se selecciona el check de procentaje*/
$('#check-porcentaje').click(function(){
    var incremento = parseFloat($('#actualizar-precio').val());
    if( incremento > 100){
        alert('El incremento en porcentaje no debe ser mayor a 100%');
        $('#check-porcentaje').prop('checked',false);
    } else {
        updateDataGrid(true, incremento);
    }
});

/**Métod que se activa cuando se escribe en el input para actualizar el precio*/
function actualizarPrecioGrid(incremento){
    var optionPorcentaje = $('#check-porcentaje').prop('checked'); 
    updateDataGrid(optionPorcentaje, incremento);   
}

/**Este metodo se utiliza cuando se escribe en el input y cuando se seleccion el check de porcentaje*/
function updateDataGrid(optionPorcentaje, incremento) {
    var total = 0;
    $('.table tr').each(function (i, row) {
        var actualrow = $(row);
        checkbox = actualrow.find('input').is(':checked');        
        if(checkbox) { // si esta seleccionado el check de la fila
            var key = $(this).attr('data-key');
            var precioProd = getPrecioGrid(key);
            var currentRow = $(this).closest('tr');
            if(optionPorcentaje) { // si esta seleccionado el check de aplciar porcentaje
                total = calcularPorcentaje(precioProd,incremento);
            } else {
                total = round(precioProd + incremento);
            }  
            //actualizar fila de precio del producto     
            currentRow.find('td:eq(2)').text(total);
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
function calcularPorcentaje(precio, porcentaje){
    var precioPor = 0;
    if(porcentaje <= 100) {
        precioPor = ((precio* porcentaje)/100);        
    } else {        
        precioPor = precio + precioPor;
    }
    return round(precioPor);   
}
"; 
$this->registerJs($js,View::POS_LOAD);