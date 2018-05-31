<?php
?>
<h1>สั่งซื้อผลไม้</h1>
<div class="row">
    <?php foreach($data as $d){?>
    <div class="col-md-2 col-lg-2 col-xs-6 col-sm-2 cols">
        <div class="images">
            <img src="<?= Yii::getAlias('@web').'/uploads/'.$d['image']?>" class="img img-responsive img-rounded">
        </div>
        <div class="contents">
            <label><?= $d['name']?></label> <br>
            <label>ราคา: <?= number_format($d['sale_price'], 2)?> บาท</label> 
            <input type="number" class="qty form-control" id="cart-<?= $d['id']?>" value="1" min="1">
        </div>
        <div class="buttons">
            <button class="btn btn-warning btn-block btnBuy" data-id="<?= $d['id']?>"><i class="fa fa-cart-plus"></i> สั่งซื้อ</button>
        </div>
    </div>
    <?php }?>
</div>
<?php
$this->registerJs("
    $('.btnBuy').on('click',function(){
        let id = $(this).attr('data-id');
        let pro_qty = $('#cart-'+id).val();
        let url = '".yii\helpers\Url::to(['/buying/buy'])."';
        if(pro_qty == '' || pro_qty == 0){
           let message='กรุณาใส่จำนวนสินค้า';
           let title = 'ตรวจสอบ';
           ".\cpn\lib\classes\CNNoty::Error('title', 'message').";
           return false;    
        }    
        $.get(url ,{id:id, qty:pro_qty},function(data){
            ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
                url = '".yii\helpers\Url::to(['/buying/get-count'])."';
                $.get(url,function(counts){
                    $('#mycartCntspan').text(counts);
                    $('#mycartCntspan').addClass('mycart_cnt');
                });
        });
        return false;
    });
");
$this->registerCss("
    .cols:hover{
        box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
        -webkit-transform: all .3s ease-in-out;
        -ms-transform: all .3s ease-in-out;
        transform: all .3s ease-in-out;
        position: relative;
    }
    .buttons{
        margin:5px 0 5px 0;text-align:center;
        
    }
    .images{
        height: 100px;
        padding:5px;   
    }
    .images .img{
        height:100%;
        width: 100%;
    }
");
?>