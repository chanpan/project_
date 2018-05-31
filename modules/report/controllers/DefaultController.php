<?php

namespace app\modules\report\controllers;

use yii\web\Controller;
use yii\db\Query;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
            return $this->redirect(['/user/login']);
        }   
        return $this->render('index');
    }
   
    public function actionGetReport()
    {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
            return $this->redirect(['/user/login']);
        }
        $stDate = isset($_GET['stDate']) ? $_GET['stDate'] : '';
        $enDate = isset($_GET['enDate']) ? $_GET['enDate'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        
        $data1 = (new Query())
                ->select(['buy.amount','buy.price','buy.total','buy.location','buy.date','u.name as uname', 'f.name'])
                ->from('buying as buy')
                ->innerJoin('users as u', 'buy.user_id = u.id')
                ->innerJoin('fruit as f', 'buy.fruit_id=f.id')
                ->where("buy.status=1")
                ->andWhere(['between', 'buy.date', "{$stDate}", "{$enDate}"])
                ->all(); 
        
        $data2 = (new Query())
                ->select(['o.id as order_id','o.locations','u.name as uname'])
                ->from('order as o')
                ->innerJoin('users as u', 'o.user_id = u.id')                
                ->where('o.status=1')
                ->andWhere(['between', 'o.date', "{$stDate}", "{$enDate}"])
                ->all();
        
        $data3 = (new Query())
                ->select(['e.name as list','e.amount','u.name as uname', 'em.name as emname'])
                ->from('expense as e')
                ->innerJoin('users as u', 'e.user_id = u.id')
                ->innerJoin('employee as em', 'e.emp_id = em.id')
                ->andWhere(['between', 'e.date', "{$stDate}", "{$enDate}"])
                ->all();
         
        //\yii\helpers\VarDumper::dump($data2, 10, true);
        return $this->renderAjax('report',[
            'data1'=>$data1,
            'data2'=>$data2,
            'data3'=>$data3,
            'status'=>$status
        ]);
        
    }
}
