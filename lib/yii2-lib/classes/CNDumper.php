<?php
 
namespace cpn\lib\classes;
 
class CNDumper {
    public static function dump($data){
        \yii\helpers\VarDumper::dump($data, 10, true);exit();
    }
    public static function print_r($data){
        print_r($data);exit();
    }
}
