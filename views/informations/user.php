<?php
    
?>
<h2>ข่าวประชาสัมพันธ์</h2>
<hr/>
<?php foreach($model as $v){ ?>
    <div> <label class="label label-success"><i class="glyphicon glyphicon-user"></i> ผู้ประกาศ: <?= $v->users->username?></label>
         <label class="label label-warning"> <i class="glyphicon glyphicon-calendar"></i> วันที่ประกาศ: <?= $v->date?></label>
    </div><br/>
<div><b><?= $v->title;?></b></div>
    <div>รายละเอียด: <?= $v->detail; ?></div>
    <hr>
<?php } ?>
