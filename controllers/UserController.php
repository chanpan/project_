<?php
 
namespace app\controllers;
use yii\web\Controller; 
use cpn\lib\classes\CNMessage;
class UserController extends Controller{
    public function actionIndex(){
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }//ถ้าไม่ใช้ admin จะเข้าไม่ได้
        return $this->render("index");
    }
    public function actionGetUser(){
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }
        $query = (new \yii\db\Query())
                ->select('*')
                ->from('users');
        if(!empty($_GET['search'])){
            $search = $_GET['search'];
            $data = $query->where('username LIKE :username OR name LIKE :name',
                    [':username'=>"%{$search}%", ':name'=>"%{$search}%"])->all();
                 
        }else{
            $data = $query->all();
        }
            
        $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $data,
            'sort' => [
                'attributes' => ['username', 'email', 'name', 'role','tel','sex'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->renderAjax("get-user",[
            'dataProvider'=>$dataProvider
        ]);
    }
    
    public function actionCreate(){
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }
         $model = new \app\models\Users();
         if($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()){
            return CNMessage::getSuccess("เพิ่มผู้ใช้สำเร็จ");
         }
         return $this->renderAjax("create",[
             'model'=>$model
         ]);
    }
    
    public function actionUpdate($id){
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }
         $model = \app\models\Users::findOne($id);
         if($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()){
             return CNMessage::getSuccess("แก้ไขผู้ใช้สำเร็จ");
         }
         return $this->renderAjax("update",[
             'model'=>$model
         ]);
    }
    
    public function actionProfile($id){
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin() && !\cpn\lib\classes\CNCheckLogin::canUser()){
           return $this->redirect(['/user/login']); 
        }
         $model = \app\models\Users::findOne($id);
         if($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()){
             return CNMessage::getSuccess("แก้ไขโปรไฟล์สำเร็จ");
         }
         return $this->render("profile",[
             'model'=>$model
         ]);
    }
    public function actionDelete($id){
        if(!\cpn\lib\classes\CNCheckLogin::canAdmin()){
           return $this->redirect(['/user/login']); 
        }
        $user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
        $model = \app\models\Users::findOne($id);
        if($id != $user_id){
            if($model->delete()){
                return CNMessage::getSuccess("ลบผู้ใช้งานสำเร็จ");
            }
        }else{
            return CNMessage::getError("ไม่สามารถลบตัวเองได้");
        }
    }
    
    public function actionRegister(){
        
        $model = new \app\models\Users();
        $model->role="user";
        if($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()){
             return CNMessage::getSuccess("สมัครสมาชิกเรียบร้อย");
        }
        return $this->render("register",[
             'model'=>$model
        ]);
    }
    
    public function actionLogin(){
        
        if(\cpn\lib\classes\CNCheckLogin::checkLogin()){
            return $this->redirect(['/site/index']);
        }
        $model = new \app\models\UserForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $post = isset($_POST['UserForm']) ? $_POST['UserForm'] : '';
            $username = isset($post['username']) ? $post['username'] : '';
            $password = isset($post['password']) ? $post['password'] : '';
            $output = CNMessage::getError("กรุณาตรวจสอบ Username หรือ Password");
            $data=(new \yii\db\Query())
                    ->select(['id','email','username','role','name','tel','sex'])
                    ->from('users')
                    ->where('username=:username AND password=:password',[
                            ':username'=>$username,
                            ':password'=>$password
                    ])->one();
            
            if(!empty($data)){
                if($data['username'] === $username){
                    \Yii::$app->session['login'] = $data;
                    return CNMessage::getSuccess("Login สำเร็จ");
                }
            }
            return $output;
        }
        return $this->render("login",[
            'model'=>$model
        ]);
    }
    
    public function actionLogout(){
        if(!\cpn\lib\classes\CNCheckLogin::checkLogin()){
            return $this->redirect(['/user/login']);
        }        
        $session = \Yii::$app->session;        
        if($session->remove('login')){
            return $this->redirect(['/user/login']);
        }        
    }
}
