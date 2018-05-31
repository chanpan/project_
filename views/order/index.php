<?php
    $this->title = "รายการสั่งซื้อ";
?>
<div class="panel panel-default">
    <div class="panel-heading"><?= $this->title?></div>
    <div class="panel-body">
        <div class="table-responsive">
        <?php if(!empty($order)){?>
<table class="table table-hover table-bordered">
    <thead >
        <tr>
            <th>รหัสสั่งซื้อ</th>
            <th>ผู้สั่งซื้อ</th>
            <th>สถานที่จัดส่ง</th>
            <th>สถานะ</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach($order as $key=>$o){?>
        <tr>
            <td><a href="<?= yii\helpers\Url::to(['/order/order-detail', 'id'=>$o['id']])?>"><?= $o['id']?></a></td>
            <td><?= $o->users->name?></td>
            <td><?= $o->locations?></td>
            <td><?php 
                if($o->status == 0){
                    echo '<label class="label label-warning">ยังไม่จัดส่ง</label>';
                }else{
                    echo '<label class="label label-success">จัดส่งสินค้าแล้ว</label>';
                }
            ?></td>
            <?php if($o->status == 0){?>
            <td style="width:50px;">
                <button data-url='<?= yii\helpers\Url::to(['/order/set-status'])?>' data-id='<?= $o->id?>' class="btn btn-success btn-sm btn-block btnSetStatus">จัดส่งสินค้าแล้ว
                </button>
                <button data-url='<?= yii\helpers\Url::to(['/order/delete-status'])?>' data-id='<?= $o->id?>' class="btn btn-danger btn-sm btn-block btnDeleteStatus">ลบ
                </button>
            </td>
            <?php }?>
        </tr>
        <?php }?>
    </tbody>
</table>

<?php } ?>

<?php 
    $this->registerJs("
    $('.btnSetStatus').click(function(){
        let url = $(this).attr('data-url');
        let id = $(this).attr('data-id');
        
        yii.confirm('ยืนยันการจัดส่งสินค้า', function(){
            $.get(url,{id:id,status:1}, function(data){
                console.log(data);
                location.reload();
            });
	});
        return false;
    });
    $('.btnDeleteStatus').click(function(){
        let url = $(this).attr('data-url');
        let id = $(this).attr('data-id');
              
        yii.confirm('คุณต้องการลบรายการนี้ใช้นี้หรือไม่', function(){
            $.post(url,{id:id}, function(data){
                location.reload();
            });
	});
        
        
        return false;
    });
");
?>
    </div>
</div>
</div>