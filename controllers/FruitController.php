<?php
 
namespace app\controllers;
 
class FruitController extends \yii\web\Controller{
    public function beforeAction($action)
    {
      if($action->id =='index' || $action->id =='get-fruit' || $action->id =='create' || $action->id =='update' || $action->id =='delete')
      {
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }
      }
      //return true;
      return parent::beforeAction($action);
    }
    //put your code here
    public function actionIndex(){
        if(!\Yii::$app->request->isAjax){
            return $this->render("index");
        }else{
            $model = (new \yii\db\Query())
                ->select('*')
                ->from('fruit')->limit(10)->all();
            return $this->renderAjax("index-ajax",['model'=>$model]);
        }
    }
    public function actionGetFruit(){
        $query = (new \yii\db\Query())
                ->select('*')
                ->from('fruit');
        if(!empty($_GET['search'])){
            $search = $_GET['search'];
            $data = $query->where('name LIKE :name',
                    [':name'=>"%{$search}%"])->all();
                 
        }else{
            $data = $query->all();
        }
            
        $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $data,
            'sort' => [
                'attributes' => ['name', 'price', 'amount'],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $this->renderAjax("get-fruit",[
            'dataProvider'=>$dataProvider
        ]);
    }
    public function actionCreate(){
        $model = new \app\models\Fruit();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
          $model->total = ($model->price * $model->amount);
          $model->image = \yii\web\UploadedFile::getInstances($model, 'image');
          if(!empty($model->image)){
                $types = '.jpg';          
                if($model->image[0]->type == 'image/jpeg'){
                    $types = '.jpg';
                }else if($model->image[0]->type == 'image/gif'){
                    $types = '.gif';
                }else if($model->image[0]->type == 'image/png'){
                    $type = '.png';
                }else{
                    $types = '.jpg';
                }
                
                $fileName = Date('YmdHis').time(). rand(9999, 99999999) . $types;
                
                $model->image[0]->saveAs('uploads/' . $fileName);
                $model->image = $fileName;
          }else{
              $model->image = "";
          }
          if($model->save()){
              return \cpn\lib\classes\CNMessage::getSuccess("บันทึกผลไม้เรียบร้อย");
          }else{
              return \cpn\lib\classes\CNMessage::getError("error");
          }
        }
        return $this->renderAjax("create",[
            'model'=>$model
        ]);
    }
    public function actionUpdate($id){       
        $model =  \app\models\Fruit::findOne($id);
        $imageOld = isset($model['image']) ? $model['image'] : '';
        if($model->load(\Yii::$app->request->post()) && $model->validate()){              
          $imageNew = \yii\web\UploadedFile::getInstances($model, 'image');
          $model->image = $imageOld;
          $model->total = ($model->price * $model->amount);
          if(!empty($imageNew[0]->name)){
                @unlink('uploads/'.$imageOld);
                $types = '.jpg';          
                if($imageNew[0]->type == 'image/jpeg'){
                    $types = '.jpg';
                }else if($imageNew[0]->type == 'image/gif'){
                    $types = '.gif';
                }else if($imageNew[0]->type == 'image/png'){
                    $type = '.png';
                }else{
                    $types = '.jpg';
                }
                $fileName = Date('YmdHis').time(). rand(9999, 99999999) . '.' . $types;
                $imageNew[0]->saveAs('uploads/' . $fileName);
                $model->image = $fileName;
          }
          
          if($model->save()){
              return \cpn\lib\classes\CNMessage::getSuccess("บันทึกผลไม้เรียบร้อย");
          }else{
              return \cpn\lib\classes\CNMessage::getError("error");
          }
        }
        return $this->renderAjax("update",[
            'model'=>$model
        ]);
    }
    public function actionDelete($id){
 
        $model = \app\models\Fruit::findOne($id);
        if($model->delete()){
           @unlink('uploads/'.$model->image);
           return \cpn\lib\classes\CNMessage::getSuccess("ลบผลไม้เรียบร้อย");
        }
    }
}
