<?php
 
namespace app\controllers;
 
class CartController extends \yii\web\Controller{
    public function actionMyCart(){
        return $this->render("my-cart");
    }
    public function actionCheckout(){
        $order = new \app\models\Order();
        if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
            $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
            $dataCart = \cpn\lib\classes\CNCart::getCart('cart');
            $order->user_id = $user_id;
            $order->locations = isset($_POST['Order']['locations']) ? $_POST['Order']['locations'] : '';
            $order->status=0;
            $order->date = date('Y-m-d');
            if($order->save()){
                foreach($dataCart as $key=>$d){
                    $detail = new \app\models\OrderDetail();
                    $detail->order_id = $order->id;
                    $detail->user_id=$user_id;
                    $detail->pro_id=$key;
                    $detail->pro_name=$d['pro_name'];
                    $detail->amount = $d['amount'];
                    $detail->prict = $d['pro_price'];
                    $detail->total = $d['sum'];
                    $detail->save();
                    $produc = \app\models\Fruit::findOne($detail->pro_id);
                    $produc->amount -= $d['amount'];
                    $produc->save();
                }
                \cpn\lib\classes\CNCart::removeCartAll('cart'); 
                return \cpn\lib\classes\CNMessage::getSuccess('บึนทึกรายการสำเร็จ');
            }else{
                return \cpn\lib\classes\CNMessage::getError('บันทึกรายการไม่สำเร็จ');
            }
        }
        return $this->render("checkout",[
             'order'=>$order
        ]);
    }
}
