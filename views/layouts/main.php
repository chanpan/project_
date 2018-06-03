<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
cpn\lib\assets\SweetAlertAsset::register($this);
cpn\lib\assets\AwesomeAsset::register($this);
cpn\lib\assets\bootbox\BootBoxAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php 
Yii::$app->name = 'ขายส่งผลไม้ออนไลน์';
$cart = '';
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    if(cpn\lib\classes\CNCheckLogin::checkLogin() === TRUE){
        if(cpn\lib\classes\CNCheckLogin::canAdmin() === TRUE){
            $items = [
                ['label' => 'ผู้ใช้', 'url' => ['/user']],
                ['label' => 'ผลไม้', 'url' => ['/fruit']],
                ['label' => 'รับซื้อผลไม้', 'url' => ['/buying']],
                ['label' => 'ค่าใช้จ่าย', 'url' => ['/expenses']],
                ['label' => 'พนักงาน', 'url' => ['/employees']],
                ['label' => 'ประชาสัมพันธ์', 'url' => ['/informations']],
                ['label' => 'การสั่งซื้อ', 'url' => ['/order']],
                ['label' => 'การขาย', 'url' => ['/sell']],
                ['label' => 'รายงาน', 'url' => ['/report/default/index']],
                [
                    'label' => '<i class="fa fa-cog"></i> ตั้งค่า',
                    'items' => [                       
                          
                        //['label' => "<i class='fa fa-file-pdf-o'></i> เอกสาร", 'url' => '/site/doc'],
                        //['label' => "<i class='fa fa-database'></i>  อัปเดท SQL", 'url' => '/site/update-sql'],
                        ['label' => "<i class='fa fa-user'></i> โปรไฟล์", 'url' => ['/user/profile', 'id'=> cpn\lib\classes\CNCheckLogin::getUserId()]],
                        ['label' => "<i class='fa fa-unlock-alt'></i> ออกจากระบบ", 'url' => '/user/logout'],
                    ],
                ],
            ];
        }else if(cpn\lib\classes\CNCheckLogin::canUser() === TRUE){
            
            if(!empty(\cpn\lib\classes\CNCart::getCountCart())){
                $cart = \cpn\lib\classes\CNCart::getCountCart();
            }
            
            $items = [
                ['label' => '<i class="fa fa-shopping-cart"></i> รถเข็นของฉัน <span id="mycartCntspan" class="mycart_cnt2">'.$cart.'</span>', 'url' => ['/cart/my-cart']],                                
                ['label' => 'ประชาสัมพันธ์', 'url' => ['/information']],
                ['label' => 'สั่งซื้อผลไม้', 'url' => ['/buying/index']],
                [
                    'label' => cpn\lib\classes\CNCheckLogin::getName(),
                    'items' => [
                         ['label' => "<i class='fa fa-check-square-o'></i> รายการสั่งซื้อ", 'url' => '/order/my-order'],
                         ['label' => "<i class='fa fa-user'></i> ข้อมูลส่วนตัว", 'url' => ['/user/profile', 'id'=> cpn\lib\classes\CNCheckLogin::getUserId()]],
                         ['label' => "<i class='fa fa-unlock-alt'></i> ออกจากระบบ", 'url' => '/user/logout'],
                    ],
                ],
            ];
        } 
        
    }else{
        $items = [
            ['label' => 'Login', 'url' => ['/user/login']],             
        ];
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php
    $this->registerJs("
        initFunc=function(){
            let cart = '".$cart."';
            if(cart != ''){
                $('#mycartCntspan').addClass('mycart_cnt');
            }
        }
        initFunc();
    ");
    $this->registerCss("
        .navbar-inverse {
            background-color: #4267b2;
            border-color: #4267b2;
        }
        .navbar-inverse .navbar-nav > li > a {
            color: #ffffff;
        }
        .navbar-inverse .navbar-brand {
            color: #ffffff;
        }
        .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus {
            color: #fff;
            background-color: #0f3788;
        }
        .mycart_cnt {
            background-color: red;
            border-radius: 50%;
            color: #fff;
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            height: 18px;
            line-height: 18px;
            position: relative;
            text-align: center;
            top: -1px;
            width: 18px;
        }
    ")
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
