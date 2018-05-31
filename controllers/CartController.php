<?php
 
namespace app\controllers;
 
class CartController extends \yii\web\Controller{
    public function actionMyCart(){
        return $this->render("my-cart");
    }
    public function actionCheckout(){
        $dataCart = \cpn\lib\classes\CNCart::getCart('cart');
        
        if(!empty($dataCart)){
            
            $total = 0;
            $dataDetail = [];

            $data =\Yii::$app->db->createCommand()
                    ->insert('order', [
                        'user_id'=> 
                        \cpn\lib\classes\CNCheckLogin::getUserId(), 
                        'locations'=>'',
                        'status'=>0, 
                        'date'=>Date('Y-m-d')
                        ])
                    ->execute();
           
            $order = \app\models\Order::find()->orderBy(['id'=>SORT_DESC])->one();

            foreach($dataCart as $key=>$d){
                $dataDetail = [
                    'order_id'=>$order->id,
                    'pro_id'=>$key,
                    'pro_name'=>$d['pro_name'],
                    'amount'=>$d['amount'],
                    'prict'=>$d['pro_price'],
                    'total'=>$d['sum'],
                    'user_id'=> \cpn\lib\classes\CNCheckLogin::getUserId()

                ];
                $data =\Yii::$app->db->createCommand()->insert('order_detail', $dataDetail)->execute();
            }
            \cpn\lib\classes\CNCookie::RemoveCookie('cart');
        }
        $model = \app\models\Order::find()->where(['user_id'=> \cpn\lib\classes\CNCheckLogin::getUserId()])->one();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
              $locations = $_POST['Order']['locations'];
              //echo $locations;exit();
                $model->locations = $locations;
                if($model->save()){
                    return "<script>alert('บันทึกรายการเรียบร้อย'); setTimeout(function(){ location.href ='".\yii\helpers\Url::to(['/site/index'])."' },1000)</script>";
                }
        }
         return $this->render("checkout",[
             'model'=>$model
         ]);
    }
}
