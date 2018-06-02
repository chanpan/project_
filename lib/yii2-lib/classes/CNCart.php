<?php

namespace cpn\lib\classes;

class CNCart {
    public static function addCart($id, $arrData, $amount, $action) {
        $cookies = CNCookie::GetCookie('cart'); //Yii::$app->session; 
        $pro_name       = isset($arrData['pro_name']) ? $arrData['pro_name'] : '';
        $pro_detail     = isset($arrData['pro_detail']) ? $arrData['pro_detail'] : '';
        $pro_price      = isset($arrData['pro_price']) ? $arrData['pro_price'] : '';
        $image          = isset($arrData['image']) ? $arrData['image'] : '';
        $imagePath      =  isset($arrData['imagePath']) ? $arrData['imagePath'] : '';
        if (!isset($cookies)) {
            $cart[$id] = [
                'pro_name' => $pro_name,
                'pro_detail' => $pro_detail,
                'pro_price' => $pro_price,
                'image' => $image,
                'imagePath' => $imagePath,
                'amount' => (int) $amount,
                'sum' => (int)$amount * $pro_price
            ];
            
        } else {           
            $cart = $cookies;//$session["cart"];
            if (array_key_exists($id, $cart)) {
                switch ($action) {
                    case "add":
                        $cart[$id] = [
                            'pro_name' => $pro_name,
                            'pro_detail' => $pro_detail,
                            'pro_price' => $pro_price,
                            'image' => $image,
                            'imagePath' => $imagePath,
                            'amount' => (int) $amount,//$cart[$id]["amount"] + 1,
                            'sum' => ((int) $amount * $pro_price) // $cart[$id]["amount"] + 1) * $pro_price
                        ];
                        
                        break;
                    case "del":
                        $cart[$id] = [
                            'pro_name' => $pro_name,
                            'pro_detail' => $pro_detail,
                            'pro_price' => $pro_price,
                            'image' => $image,
                            'imagePath' => $imagePath,
                            'amount' => (int) $amount,//$cart[$id]["amount"] - 1,
                            'sum' => ((int) $amount * $pro_price)//((int) $cart[$id]["amount"] - 1) * $pro_price
                        ];
                        break;
                }
            } else { 
                $cart[$id] = [
                    'pro_name' => $pro_name,
                    'pro_detail' => $pro_detail,
                    'pro_price' => $pro_price,
                    'image' => $image,
                    'imagePath' => $imagePath,
                    'amount' => (int) $amount,
                    'sum' => $amount * $pro_price
                ];
            }
        }
        if(CNCookie::SetCookie('cart', $cart)){
            return TRUE;
        }else{
            return FALSE;
        }
        //$session["cart"] = $cart;
        // $session->destroy();
    }
    public static function getCart($name){
       return CNCookie::GetCookie($name);
    }
    public static function getCountCart(){
       return count(CNCookie::GetCookie('cart'));
    }
    public static function removeCartAll($name){
       return CNCookie::RemoveCookie($name);
    }
    
}
