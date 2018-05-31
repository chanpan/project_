<?php
    use yii\bootstrap\ActiveForm;
    $this->title="ชำระเงิน";
?>
<?php $form = ActiveForm::begin();?>
<div class="panel panel-default">
    <div class="panel-heading">ที่อยู่สำหรับจัดส่งสินค้า <?= cpn\lib\classes\CNCheckLogin::getName()?></div>
    <div class="panel-body">
        
            
            <?= $form->field($model, 'locations')->textarea(); ?>
        
    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</div>
<?php ActiveForm::end();?>