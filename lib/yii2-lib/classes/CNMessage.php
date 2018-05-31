<?php
 
namespace cpn\lib\classes;
 
class CNMessage {
   public static function Response(){
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
   } 
   public static function getSuccess($message, $options=''){
       CNMessage::Response();
       return [
           'status'=>'success',
           'title'=>'Success',
           'message'=>$message,
           'options'=> isset($options) ? $options : ''
       ];
   }
   public static function getError($message){
       CNMessage::Response();
       return [
           'status'=>'error',
           'title'=>'Error',
           'message'=>$message
       ];
   }
}
