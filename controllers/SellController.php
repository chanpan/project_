<?php

namespace app\controllers;

use Yii;
use app\models\Sell;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SellController implements the CRUD actions for Sell model.
 */
class SellController extends Controller
{
    
    public function actionIndex()
    {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
            return $this->redirect(['/user/login']);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => Sell::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

      
    public function actionUpdate($id)
    {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
            return $this->redirect(['/user/login']);
        }
        $model = Sell::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return \cpn\lib\classes\CNMessage::getSuccess('แก้ไขการขายเรียบร้อย');
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

     
    public function actionDelete($id)
    {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
            return $this->redirect(['/user/login']);
        }
        $model = Sell::findOne($id);
        if($model->delete()){
            return \cpn\lib\classes\CNMessage::getSuccess("ลบการขายสำเร็จ");
        }else{
            return \cpn\lib\classes\CNMessage::getError("ลบการขายไม่สำเร็จ");
        }
    }
 
}
