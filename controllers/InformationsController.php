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
use app\models\Information;

class InformationsController extends Controller {
  public function beforeAction($action)
    {
      if($action->id =='index'  || $action->id =='create' || $action->id =='update' || $action->id =='delete')
      {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }
      }
      //return true;
      return parent::beforeAction($action);
    } 
    public function actionIndex() { 
        
        
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $model = Information::find()->where(['LIKE', 'title', $search])->orderBy(['id'=>SORT_DESC]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
      
            return $this->render("index", [
                        'dataProvider' => $dataProvider
            ]);
         
        
    }

    public function actionCreate() { 
        
        $model = new Information();
        if ($model->load(Yii::$app->request->post())) {
            $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
            $model->user_id = $user_id;
            $model->date = Date('Y-m-d');
            if ($model->save()) {
                return $this->redirect(['/informations/index']);
            }
        }
        return $this->render("create", [
                    'model' => $model
        ]);
    }

    public function actionUpdate($id) {
        
        $model = Information::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
            $model->user_id = $user_id;
            $model->date = Date('Y-m-d');
            if ($model->save()) {
                return $this->redirect(['/informations/index']);
            }
        }
        return $this->render("update", [
                    'model' => $model
        ]);
    }

    public function actionDelete($id) {
         
        $model = Information::findOne($id);
        if ($model->delete()) {
            return $this->redirect(['/informations/index']);
        }
    }

}
