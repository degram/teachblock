<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
		'css/bootstrap.css',
		'css/font-awesome.min.css',
		'//fonts.googleapis.com/css?family=Oswald:400,700',
		'//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/sunny/jquery-ui.css',
    ];
    public $js = [
		'js/main.js',
		'//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
		'//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
