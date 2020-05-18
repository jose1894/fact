<?php
namespace app\assets;

use yii\web\AssetBundle;

class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
      'datatables.net/js/jquery.dataTables.min.js',
      'datatables.net-bs/js/dataTables.bootstrap.min.js',
      'iCheck/icheck.min.js',
    ];
    public $css = [
        'datatables.net-bs/css/dataTables.bootstrap.min.css',
        'iCheck/all.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
