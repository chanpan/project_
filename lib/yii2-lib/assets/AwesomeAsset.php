<?php

 
namespace cpn\lib\assets; 
 
class AwesomeAsset extends \yii\web\AssetBundle{
    public $sourcePath='@cpn/lib/assets/awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
    public $js = [
//        'sweetalert2.min.js',
    ];
    public $depends=[
 
    ];
}
