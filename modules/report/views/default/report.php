
<?php 
    $su1=0;
    $su2=0;
    $su3=0;
    $status = isset($status) ? $status : 2;
?>
<?php if($status == 1): ?>
<link rel="stylesheet" href="<?= \yii\helpers\Url::to('@web/bootstrap/css/bootstrap.min.css')?>"/>
<?php endif;?>
<br/>
<div >
    <h3>รายงานการรับซื้อผลไม้</h3>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อผลไม้</th>
                <th>จำนวน</th>
                <th>ราคา/กก.</th>
                <th>ราคารวม</th>
                <th>สถานที่ซื้อ</th>
                <th style="width:150px">บันทึกโดย</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data1 as $key=>$value){?>
            <?php 
                $su1 += $value['total'];
            ?>
            <tr>
                <td><?= $key+1; ?></td>
                <td><?= $value['name']?></td>
                <td><?= $value['amount']?></td>
                <td><?= $value['price']?></td>
                <td><?= $value['total']?></td>
                <td><?= $value['location']?></td>
                <td><?= $value['uname']?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">ราคารวม</td>         
                <td><?= number_format($su1, 2) ?> บาท</td>
            </tr>
        </tfoot>
    </table>
</div>
<br/>
<div >
    <h3>รายงานการขายผลไม้</h3>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>รายการขาย</th>  
                <th>สถานที่จัดส่ง</th>
                <th>ชื่อลูกค้า</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data2 as $key=>$value){?>
            <?php 
                 
            ?>
            <tr>
                <td><?= $key+1; ?></td>
                <td>
                    <?php 
                        $details = (new yii\db\Query())->select('*')->from('order_detail')->where(['order_id'=>$value['order_id']])->all();
                    ?>
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>ชื่อผลไม้</th>
                                <th>จำนวน</th>
                                <th>ราคา/กก.</th>
                                <th>ราคารวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($details as $d){?>
                            <tr>
                                <?php 
                                    $su2 += $d['total'];
                                ?>
                                <td><?= $d['pro_name']?></td>
                                <td><?= $d['amount']?></td>
                                <td><?= $d['prict']?></td>
                                <td><?= $d['total']?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                 
                    
                    
                </td>
                <td><?= $value['locations']?></td>
                <td><?= $value['uname']?></td>                   
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">ราคารวม</td>         
                <td><?= number_format($su2, 2) ?> บาท</td>
            </tr>
        </tfoot>
    </table>
</div>
<?php if($status == 1): ?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<?php endif;?>
<br/>
<div >
    <h3>รายงานค่าใช้จ่าย</h3>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>รายการ</th>
                <th>จำนวนเงิน</th> 
                <th>ชื่อพนักงาน</th>
                <th style="width:150px">บันทึกโดย</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data3 as $key=>$value){?>
            <?php 
                $su3 += $value['amount'];
            ?>
            <tr>
                <td><?= $key+1; ?></td>
                <td><?= $value['list']?></td>
                <td><?= $value['amount']?></td>
                <td><?= $value['emname']?></td>
                <td><?= $value['uname']?></td> 
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">ราคารวม</td>         
                <td><?= number_format($su3, 2) ?> บาท</td>
            </tr>
        </tfoot>
    </table>
</div>
<br/>
<div>
    <label><b>รวมเงินทั้งสิ้น</b> : <?= number_format($su2-($su1+$su3), 2)?> บาท</label>
    
</div>

<?php 
    $this->registerJs("
        const status = '".$status."';
        if(status == 1){
             window.print();
        }
    ");
?>