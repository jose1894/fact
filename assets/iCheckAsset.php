<?php
namespace app\assets;

use yii\web\AssetBundle;

class iCheckAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
        'iCheck/icheck.min.js',
    ];
    public $css = [
        'iCheck/all.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
