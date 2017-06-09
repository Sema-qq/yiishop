<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "public/css/bootstrap.min.css",
        "public/css/font-awesome.min.css",
        "public/css/prettyPhoto.css",
        "public/css/price-range.css",
        "public/css/animate.css",
        "public/css/main.css",
        "public/css/responsive.css",
    ];
    public $js = [
//        "public/js/jquery.js",
        "public/js/jquery.cycle2.min.js",
        "public/js/jquery.cycle2.carousel.min.js",
        "public/js/bootstrap.min.js",
        "public/js/jquery.scrollUp.min.js",
        "public/js/price-range.js",
        "public/js/jquery.prettyPhoto.js",
        "public/js/main.js",
    ];
    public $depends = [
    ];
}
