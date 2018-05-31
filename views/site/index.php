<?php

/* @var $this yii\web\View */

$this->title = 'ระบบขายส่งผลไม้';
 
?>
<h1>555</h1>
<h3 class="text-center">ยินดีต้อนรับเข้าสู่ระบบ ขายส่งผลไม้ออนไลน์</h3> 
<div class="clearfix"></div>
<div class="col-md-3" style="cursor: pointer">
    <a href="/user"><div style="background: #337ab7;
 
    padding: 10px;
    text-align: center;
    margin-left: 15px;
    margin-bottom: 10px;
    border-radius: 9px;
    font-size: 16pt;
    color: #fff;">
        <label>จำนวนผู้ใช้ทั้งหมด  <br> <?= isset($countUser) ? $countUser : 0?></label>
        </div></a>
</div>
<div class="col-md-3" <a href="/fruit">
    <a href="/fruit"><div style="background: #5cb85c; 
    padding: 10px;
    text-align: center;
    margin-left: 15px;
    margin-bottom: 10px;
    border-radius: 9px;
    font-size: 16pt;
    color: #fff;cursor: pointer">
        <label>จำนวนผลไม้ทั้งหมด  <br> <?= isset($countFruit) ? $countFruit : 0?></label>
        </div></a>
</div>

<div class="clearfix"></div>
<div class="col-md-4">
    
    <div id="view-order"></div>
</div>
<div class="col-md-4">
    <div class="table-responsive">
        <div id="view-information"></div>
    </div>
</div>
<div class="col-md-4">
    <div id="view-fruit"></div>
</div>
<?php 
    $this->registerJs("
        $.get('/order/index',function(data){
            $('#view-order').html(data);
        });
        $.get('/information/index',function(data){
            $('#view-information').html(data);
        });
        $.get('/fruit/index',function(data){
            $('#view-fruit').html(data);
        });
    ");
?>