<?php
    use yii\bootstrap\ActiveForm;
    $this->title="ชำระเงิน";
?>
<?php $form = ActiveForm::begin([
    'id'=>'frmCheckout'
]);?>
<div class="panel panel-default">
    <div class="panel-heading">ที่อยู่สำหรับจัดส่งสินค้า <?= cpn\lib\classes\CNCheckLogin::getName()?></div>
    <div class="panel-body">
        
            
            <?= $form->field($order, 'locations')->textarea(); ?>
        
    </div>
    <div class="panel-footer text-right">
        <?= \yii\helpers\Html::submitButton('บันทึก', ['class'=>'btn btn-primary'])?>
    </div>
</div>
<?php ActiveForm::end();?>

<?php 
    $this->registerJs("
        $('#frmCheckout').on('beforeSubmit',function(){
            let frm = $(this);
            let frmData = frm.serialize();
            $.post(frm.attr('action'), frmData, function(data){
                if(data.status=='success'){
                    ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";                    
                }else{
                    ".\cpn\lib\classes\CNNoty::Error('data.title', 'data.message').";
                }
            });
            return false;
        }); 
    ");
?>