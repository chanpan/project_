<?php
    $this->title = 'รถเข็นของฉัน';
?>

<h2><?= $this->title;?></h2>
<h3>รถเข็น - รายการสินค้าที่รอการชำระเงิน</h3>

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
            $data = \cpn\lib\classes\CNCart::getCart('cart');
            
            $total = 0;
           // print_r($data);
           
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
                    <?php  foreach($data as $d){  $total += $d['sum']?>
                    <tr>
                        
                        <td><img src="<?= $d['imagePath'].$d['image']?>" class="img img-responsive" style="width:100px;"></td>
                        <td><?= $d['pro_detail']?></td>
                        <td><?= $d['amount']?></td>
                        <td><?= number_format($d['sum'] , 2)?></td>
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
                <div class="pull-right"><b><?= number_format($total, 2);?> บาท</b></div>
            </div>
        </div>
    </div>
</div>
<?php if(!empty($data)):?>
<div class="pull-right">
    <a href="<?= yii\helpers\Url::to(['/cart/checkout'])?>" class="btn btn-info"><i class="fa fa-cart-plus"></i> ชำระเงิน</a>
</div>
<?php endif; ?>