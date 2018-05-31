<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of ReportController
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
class ReportController extends \yii\web\Controller{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionSell()
    {
        $date1 = isset($_GET['date1']) ? $_GET['date1'] : '';
        $date2 = isset($_GET['date2']) ? $_GET['date2'] : '';
        
        $sql="SELECT o.id,o.locations,u.name,o.date,od.pro_name,od.pro_id,od.amount,od.prict,od.total FROM `order` as o 
            INNER JOIN order_detail as od on o.id=od.order_id
            INNER JOIN users as u on od.user_id=u.id
            WHERE o.status=1";
        if(!empty($date1) && $date2){
            $sql="SELECT o.id,o.locations,u.name,o.date,od.pro_name,od.pro_id,od.amount,od.prict,od.total FROM `order` as o 
            INNER JOIN order_detail as od on o.id=od.order_id
            INNER JOIN users as u on od.user_id=u.id
            WHERE o.date BETWEEN '{$date1}' AND '{$date2}'; AND o.status=1";
        }
        //echo $sql;exit();
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
         
        return $this->render('sell',['data'=>$data]);
    }
    
    public function actionExpends()
    {
        $date1 = isset($_GET['date1']) ? $_GET['date1'] : '';
        $date2 = isset($_GET['date2']) ? $_GET['date2'] : '';
        
        $sql="SELECT e.name as e_name, e.amount,e.date,u.name FROM expense as e
            INNER JOIN users as u on e.emp_id=u.id";
        if(!empty($date1) && $date2){
            $sql="SELECT e.name as e_name, e.amount,e.date,u.name FROM expense as e
            INNER JOIN users as u on e.emp_id=u.id
            WHERE e.date BETWEEN '{$date1}' AND '{$date2}';";
        }
        //echo $sql;exit();
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        
        return $this->render('expends',['data'=>$data]);
    }
}
