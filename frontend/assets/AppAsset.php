<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['css/brand_styles.css'];
    public $js = ['js/brand_app.js'];
    public $depends = [
        'yii\web\YiiAsset',    // provides jQuery, etc.
    ];
}