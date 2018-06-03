<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
     
    public function actionIndex()
    {
        if(!\cpn\lib\classes\CNCheckLogin::checkLogin()){
            return $this->redirect(['/user/login']); 
        }
        $sqlUser="SELECT count(*) FROM users";
        $countUser = Yii::$app->db->createCommand($sqlUser)->queryScalar();
        
        $sqlFruit="SELECT count(*) FROM fruit";
        $countFruit = Yii::$app->db->createCommand($sqlFruit)->queryScalar();
        
        if(\cpn\lib\classes\CNCheckLogin::canUser()){
           return $this->redirect(['/buying/index']); 
        } 
        return $this->render('index',['countUser'=>$countUser, 'countFruit'=>$countFruit]);
    }

    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionUpdateSql()
    {
        if(!empty($_POST)){
            $txtSql = $_POST['txtSql'];
            Yii::$app->db->createCommand($txtSql)->execute();
            return \cpn\lib\classes\CNMessage::getSuccess('Success');
        }
        return $this->render('update-sql');
    }
    public function actionDoc()
    {
       return $this->render('doc');
    }
}
