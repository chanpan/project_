<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of OrderController
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
class OrderController extends \yii\web\Controller{
    public function beforeAction($action)
    {
      if($action->id =='index'  || $action->id =='set-status' || $action->id =='order-detail' || $action->id =='delete-status')
      {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }
      }
      //return true;
      return parent::beforeAction($action);
    } 
    public function actionIndex()
    {
        $order = \app\models\Order::find()->all();
        if(\Yii::$app->request->isAjax){
            return $this->renderAjax('index', ['order'=>$order]);
        }else{
            return $this->render('index', ['order'=>$order]);
        }
        
    }
    public function actionSetStatus()
    {
        $id= isset($_GET['id']) ? $_GET['id'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
 
        $order = \app\models\Order::findOne($id);
        $order->status = 1;
        if($order->save()){
            $sell = new \app\models\Sell();
            $sell->order_id = $id;
            $sell->user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
            $sell->mem_id = $order->user_id;
            $sell->date = date('Y-m-d');
            if($sell->save()){
                return \cpn\lib\classes\CNMessage::getSuccess('บันทึกการจัดส่งสำเร็จ');
            }else{
                return \cpn\lib\classes\CNDumper::dump($sell->errors);
            }
        }
        
        
    }
    
    public function actionOrderDetail()
    {
        $id= isset($_GET['id']) ? $_GET['id'] : '';
        $sql = "
            SELECT od.id,od.pro_name,od.prict,od.amount,od.total , f.image, u.name FROM order_detail as od
            INNER JOIN fruit as f on f.id = od.pro_id
            INNER JOIN users as u on u.id = od.user_id
            WHERE od.order_id = :id
        ";
        $data = \Yii::$app->db->createCommand($sql,[':id'=>$id])->queryAll();
       // print_r($data);exit();
        return $this->render('order-detail', ['data'=>$data]);
    }
    
    public function actionDeleteStatus()
    {
        
        $detail = \app\models\OrderDetail::find()->where(['order_id'=>$_POST['id']])->all(); 
        foreach($detail as $d){
            $fruit= \app\models\Fruit::find()->where(['id'=>$d['pro_id']])->one();
            $fruit->amount += $d['amount'];
            $fruit->total = $fruit->price * $fruit->amount;
            $fruit->update();
        }
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $order = \app\models\Order::findOne($id)->delete();
        \Yii::$app->db->createCommand("DELETE FROM order_detail WHERE order_id=:id",[':id'=>$id])->execute();
    }
    
    public function actionMyOrder()
    {
        $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
        $order = \app\models\Order::find()->where(['user_id'=>$user_id])->all();
        return $this->render('my-order',[
            'order'=>$order
        ]);
    }
    public function actionMyOrderDetail()
    {
        $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
        $detail = \app\models\OrderDetail::find()
                ->where('order_id=:id',[':id'=>$_GET['id']])
                ->all();
        
        return $this->renderAjax('my-order-detail',[
            'detail'=>$detail
        ]);
    }
}
