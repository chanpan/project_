<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

/**
 * Description of InformationController
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
class InformationController extends \yii\web\Controller{
    public function actionIndex(){
        $model = \app\models\Information::find()->all();
        
        if(\Yii::$app->request->isAjax){
            return $this->renderAjax("index", ['model'=>$model]);
        }else{
            return $this->render("index", ['model'=>$model]);
        }
    }
}
