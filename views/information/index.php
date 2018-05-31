<?php

?>

<?php if(!empty($model)){?>

<div class="panel panel-default">
    <div class="panel-heading">ประชาสัมพันธ์</div>
    <div class="panel-body">
        <div class="">
        <?php foreach($model as $m){?>
            <div>
                <label>ชื่อเรื่อง: <?= $m['title']?></label>  <br> 
                <label>รายละเอียด: <?= $m['detail']?></label><br>
                <label><i class="fa fa-calendar"></i> วันที่ประกาศ : <?= $m['date']?></label>  <label><i class="fa fa-user"></i> ประกาศโดย : <?= $m->users->name?></label>
            </div><hr/>
        <?php } ?>
        </div>
    </div>
</div>

<?php } ?>
