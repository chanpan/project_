<?php
    $this->title = 'รายละเอียดการสั่งซื้อของลูกค้า';
?>

<h2><?= $this->title;?></h2> 

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
        <?php 
           
            $total = 0;
        
           
        ?>
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
                    <?php if(!empty($data)):?>
                    <?php  foreach($data as $d){  $total += $d['total']?>
                    <tr>
                        
                        <td><img src="<?= Yii::getAlias('@web').'/uploads/'.$d['image']?>" class="img img-responsive" style="width:100px;"></td>
                        <td><?= $d['name']?></td>
                        <td><?= $d['amount']?></td>
                        <td><?= number_format($d['total'] , 2)?></td>
                    </tr>
                    <?php }?>
                    <?php endif; ?>
                    
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left"><b>รวมทั้งสิ้น</b></div>
                <div class="pull-right"><b>THB <?= number_format($total, 2);?></b></div>
            </div>
        </div>
    </div>
</div>
 