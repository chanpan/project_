<?php
$this->title = 'รายการสั่งซื้อทั้งหมด';
?>

<div class="row">
    
    <div class="col-md-8">
        <h2><?= $this->title;?></h2>
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
                            <th>สถานะการสั่งซื้อ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order as $o) { ?>
                            <tr>
                                <td><a href="<?= \yii\helpers\Url::to(['/order/my-order-detail','id'=>$o['id']])?>">ODR<?= $o['id']; ?></a></td>
                                <td><?= $o['date']; ?></td>
                                <td><?= ($o['status'] == 1) ? 'ชำระเงินแล้ว' : 'ยังไม่ชำระเงิน'; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>