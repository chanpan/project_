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
        //print_r($_GET);exit();
        \Yii::$app->db->createCommand()->update('order', ['status'=>1], ['id'=>$id])->execute();
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
        
        return $this->render('my-order-detail',[
            'detail'=>$detail
        ]);
    }
}
