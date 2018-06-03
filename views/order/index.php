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
            <th style="width:200px;"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($order as $key=>$o){?>
        <tr>
            <td><a href="<?= yii\helpers\Url::to(['/order/order-detail', 'id'=>$o['id']])?>"><?= $o['id']?></a></td>
            <td><?= isset($o->users->name) ? $o->users->name  : ''?></td>
            <td><?= $o->locations?></td>
            <td><?php 
                if($o->status == 0){
                    echo '<label class="label label-warning">ยังไม่จัดส่ง</label>';
                }else{
                    echo '<label class="label label-success">จัดส่งสินค้าแล้ว</label>';
                }
            ?></td>
            <?php if($o->status == 0):?>
            <td style="text-align: center;">
                <button data-url='<?= yii\helpers\Url::to(['/order/set-status'])?>' data-id='<?= $o->id?>' class="btn btn-success btn-xs btnSetStatus"><i class="fa fa-ambulance"></i> จัดส่งสินค้าแล้ว
                </button>
                <button data-url='<?= yii\helpers\Url::to(['/order/delete-status'])?>' data-id='<?= $o->id?>' class="btn btn-danger btn-xs btnDeleteStatus"><i class="fa fa-trash"></i> ลบ
                </button>
            </td>
            <?php else:?>
                <td>-</td>
            <?php endif; ?>
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
                
                if(data.status=='success'){
                    ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";                     
                }else{
                    ".\cpn\lib\classes\CNNoty::Error('data.title', 'data.message').";
                }
                setTimeout(function(){
                    location.reload();
                },1000);
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