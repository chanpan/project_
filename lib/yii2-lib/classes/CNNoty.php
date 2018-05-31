<?php
namespace cpn\lib\classes;
class CNNoty{
   public static function Success($title, $message){
       $js = '
            swal(                    
                    ' . $message . ',
                    "",
                    "success"
                  );  
        ';
        return $js;
   }
   public static function Error($title, $message){
        $js = '
            swal(                    
                    ' . $message . ',
                    "",
                    "error",
                     
                  );  
        ';
        
        return $js;
    }
}
