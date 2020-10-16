<?php
namespace app\assets;

use yii\web\AssetBundle;

class DatatableAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components';
    public $js = [
        // 'iCheck/icheck.min.js',
        'datatables.net/js/jquery.dataTables.min.js',
        'datatables.net-bs/js/dataTables.bootstrap.min.js',
        'chart.js/Chart.js',
        'morris.js/morris.min.js'
    ];
    public $css = [
        'datatables.net-bs/css/dataTables.bootstrap.min.css',
        'morris.js/morris.css',
        // 'iCheck/all.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
