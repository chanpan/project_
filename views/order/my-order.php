<?php
$this->title = 'รายการสั่งซื้อทั้งหมด';
?>

<div class="row">
    <div class="col-md-6">
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?= $this->title; ?>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>หมายเลขใบสั่งซื้อ</th>
                            <th>วันที่</th>
                            <th style="width:150px;">สถานะการสั่งซื้อ</th>
                            <th>ที่อยู่สำหรับจัดส่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order as $o) { ?>
                            <tr>
                                <td><a class="btnDetail" href="<?= \yii\helpers\Url::to(['/order/my-order-detail','id'=>$o['id']])?>">ODR<?= $o['id']; ?></a></td>
                                <td><?= $o['date']; ?></td>
                                <td class="text-center"><?= ($o['status'] == 1) ? '<label class="label label-primary">ชำระเงินแล้ว</label>' : '<label class="label label-warning">ยังไม่ชำระเงิน</label>'; ?></td>
                                <td><?= $o['locations']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div id="myDetail"></div>
    </div>
</div>
<?php 
$this->registerJs("
    $('.btnDetail').click(function(){
        let url = $(this).attr('href');
        $.get(url, function(data){
            $('#myDetail').html(data);
        });
        return false;
    });   

");
?>