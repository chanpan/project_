<?php

namespace cpn\lib\classes;


class CNCheckLogin {
    public static function checkLogin(){
        if(\Yii::$app->session['login']){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function canAdmin(){
        $status = FALSE;
        if(\Yii::$app->session['login']){
            if(\Yii::$app->session['login']['role'] === 'admin'){
                $status = TRUE;
            }
        }
        return $status;
    }
    
    public static function canUser(){
        $status = FALSE;
        if(\Yii::$app->session['login']){
            if(\Yii::$app->session['login']['role'] === 'user'){
                $status = TRUE;
            }
        }
        return $status;
    }
    public static function getUserId(){
        
        if(\Yii::$app->session['login']){
           return \Yii::$app->session['login']['id'];
        }
        
    }
     public static function getName(){
        
        if(\Yii::$app->session['login']){
           return \Yii::$app->session['login']['name'];
        }
        
    }
}
