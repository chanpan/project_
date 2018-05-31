<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of EmployeesController
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
use yii\web\Controller;
use Yii;
use app\models\Expense;
class ExpensesController extends Controller{
     
    public function actionIndex(){
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $model =  Expense::find()->where(['LIKE', 'name', $search]);       
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 20,
            ], 
        ]);
        return $this->render("index",[
            'dataProvider'=>$dataProvider
        ]);
    }
    public function actionCreate(){
        $model = new Expense();         
        if($model->load(Yii::$app->request->post())){
            $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
            $model->user_id = $user_id;
             
            $model->date = Date('Y-m-d');
            if($model->save()){
                return $this->redirect(['/expenses/index']);
            }
            
        }
        return $this->render("create",[
            'model'=>$model
        ]);
    }
    public function actionUpdate($id){
        $model = Expense::findOne($id);         
        if($model->load(Yii::$app->request->post())){
            $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
            $model->user_id = $user_id;
            $model->date = Date('Y-m-d');
            if($model->save()){
                return $this->redirect(['/expenses/index']);
            }
            
        }
        return $this->render("update",[
            'model'=>$model
        ]);
    }
    public function actionDelete($id){
        $model = Expense::findOne($id);         
        if($model->delete()){
            return $this->redirect(['/expenses/index']);
        }
    }
}
