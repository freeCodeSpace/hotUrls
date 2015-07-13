<?php
namespace app\assets;
use yii\web\AssetBundle;

/**
 * Базовые насткройки для использования на главной странице
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
    ];
}
