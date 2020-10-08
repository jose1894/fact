<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\web\View;
use app\models\Producto;
use yii\helpers\Url;
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
            'precio_lista',
        ],
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
                }).done(function(data){});
            } else {
                $('#actualizar-precio').val('');
                $('#check-porcentaje').prop('checked',false);
            }
        }        
    }
})
/**Para calcular el porcentaje al precio */
function calcularPorcentaje(precio, porcentaje){
    var precioPor = (precio* porcentaje)/100;
    return precio = round(precio + precioPor);
}
";
$this->registerJs($js,View::POS_LOAD);