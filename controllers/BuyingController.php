<?php

namespace app\controllers;

class BuyingController extends \yii\web\Controller {

    public function actionIndex() {
        if(\cpn\lib\classes\CNCheckLogin::canAdmin()){
            return $this->render("index");
        }else{
            $data = (new \yii\db\Query())->select('*')->from('fruit')->where('amount > 0')->all();
            return $this->render("user", ['data'=>$data]);
        }
    }
    public function actionBuy() {
       $id = isset($_GET['id']) ? $_GET['id'] : '';
       $amount = isset($_GET['qty']) ? $_GET['qty'] : '';       
       $arrData = (new \yii\db\Query())->select("*")->from('fruit')->where(['id'=>$id])->one();
       $modelArray = [
            'pro_name' => $arrData['name'],
            'pro_detail' => $arrData['name'],
            'pro_price' => $arrData['price'],
            'image' => $arrData['image'],
            'imagePath' => \Yii::getAlias('@web').'/uploads/',
            'amount' => (int) $amount,//จำนวนที่ลูกค้าสั่งซื้อ
            'sum' => (int) $amount * $arrData['price']
        ];
        $data =\cpn\lib\classes\CNCart::addCart($id, $modelArray, $amount, "add");
        if($data){
            $out = \cpn\lib\classes\CNCookie::GetCookie('cart');
            return \cpn\lib\classes\CNMessage::getSuccess("สั่งซื้อสินค้าเรียบร้อย",$out);
        }
    }
    public function actionGetCount() {
        $out = \cpn\lib\classes\CNCart::getCountCart();
        return $out;
    }
    

    public function actionGetBuying() {
        $query = (new \yii\db\Query())
                ->select(['b.id','f.name','f.image', 'b.amount','b.status','b.date','b.price','b.total','u.name as uname'])
                ->from('buying as b')
                ->innerJoin('fruit as f', 'b.fruit_id=f.id')
                ->innerJoin('users as `u` ', 'b.user_id=u.id')
                ->orderBy(['b.id'=>SORT_DESC]);
        
        if (!empty($_GET['search'])) {
            $search = $_GET['search'];
            $data = $query->where('f.name LIKE :name', [':name' => "%{$search}%"])->all();
        } else {
            $data = $query->all();
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['name','amount', 'price', 'total','uname','date'],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $this->renderAjax("get-buying", [
                    'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionCreate(){
        $model = new \app\models\Buying();
        $model->user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
        $model->status = 2;
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            
            $model->date = Date('Y-m-d');
            if ($model->save()) {
                if($model->status == 1){
                    $dataFruit= \app\models\Fruit::findOne($model->fruit_id);
                    $dataFruit->amount += $model->amount;
//                    $dataFruit->price  += $model->price;
                    $dataFruit->total  += ($model->amount * $model->price);
                    $dataFruit->update();
                }
                return \cpn\lib\classes\CNMessage::getSuccess("บันทึกผลไม้เรียบร้อย");
            } else {
                return \cpn\lib\classes\CNMessage::getError("error");
            }
        }
        return $this->renderAjax("create", [
            'model' => $model
        ]);
    }
    public function actionUpdate($id){
        $model = \app\models\Buying::findOne($id);
        $model->user_id = \cpn\lib\classes\CNCheckLogin::getUserId();
         
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            
            $model->date = Date('Y-m-d');
            if ($model->save()) {
                if($model->status == 1){
                    $dataFruit= \app\models\Fruit::findOne($model->fruit_id);
                    $dataFruit->amount += $model->amount;
//                    $dataFruit->price  += $model->price;
                    $dataFruit->total  += ($model->amount * $model->price);
                    $dataFruit->update();
                }
                return \cpn\lib\classes\CNMessage::getSuccess("บันทึกผลไม้เรียบร้อย");
            } else {
                return \cpn\lib\classes\CNMessage::getError("error");
            }
        }
        return $this->renderAjax("create", [
            'model' => $model
        ]);
    }
    public function actionDelete($id){ 
        $model = \app\models\Buying::findOne($id);
        if($model->delete()){ 
           return \cpn\lib\classes\CNMessage::getSuccess("ลบรายการสั่งซื้อผลไม้เรียบร้อย");
        }
    }
     public function actionGetFruit($id){ 
        $model = \app\models\Fruit::findOne($id);
        if(!empty($model)){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model;
        }
    }
    
    public function actionCheckCount() {
       if(!empty($_GET)){
           $id = isset($_GET['id']) ? $_GET['id'] : '';
           $count = isset($_GET['count']) ? $_GET['count'] : '';
           $model = \app\models\Fruit::find()->where('id=:id',[':id'=>$id])->one();
           $status = [];
           \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

           if($count > $model->amount){
               $status = ['status'=>1, 'message'=>'จำนวนสินค้าเหลือไม่เพียงพอ' , 'count'=>$model->amount];
           }else{
               $status = ['status'=>0];
           }
           return $status;
       } 
       
    }

}
