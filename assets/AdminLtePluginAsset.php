<?php
namespace app\assets;

use yii\web\AssetBundle;

class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';
    public $js = [
      'bower_components/datatables.net/js/jquery.dataTables.min.js',
      'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
      'bower_components/iCheck/icheck.min.js',
    ];
    public $css = [
        'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
        'bower_components/iCheck/all.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
