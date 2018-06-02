<?php
$this->title = 'รายการสั่งซื้อทั้งหมด';
$total=0;
//\cpn\lib\classes\CNDumper::dump($detail);
?>
<h2><?= $this->title;?></h2> 
<a href="/order/my-order">ย้อนกลับ</a>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <label class="pull-left">รายการ</label>
                    <label class="pull-right">ราคา / ยอดรวม (ยังไม่สุทธิ)</label>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div id="content">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>รายการ</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($detail as $key=>$d){?>
                    <?php $total += $d->total;?>
                    <tr>
                        <td><?= $key+1;?></td>
                        <td>
                            <img style="width:50px;float: left;margin-right:10px;" 
                                 src="<?= Yii::getAlias('@web').'/uploads/'.$d->fruits->image?>" 
                                 class="img img-responsive img-rounded">
                            <label><?= $d->fruits->name;?></label>
                        </td>
                        <td>
                            <?= $d->amount;?>
                        </td>
                        <td><?= number_format($d->total, 2);?> บาท</td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left"><b>รวมทั้งสิ้น</b></div>
                <div class="pull-right"><b><?= number_format($total, 2);?> บาท</b></div>
            </div>
        </div>
    </div>
</div>
 