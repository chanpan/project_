<?php
 
namespace app\controllers;
use yii\web\UploadedFile; 
use Yii;
class UploadController extends \yii\web\Controller{
   public function actionImage() {
       $model = new \app\models\Upload(); 
       $dataImage = (new \yii\db\Query())->select("*")->from('upload')->all();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstances($model, 'image');
            if($model->upload()){
                $this->refresh();              
            }
            
        } 
       return $this->render('image', ['model'=>$model, 'dataImage'=>$dataImage]);
   }

}
