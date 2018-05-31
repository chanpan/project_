<?php
    use yii\bootstrap\ActiveForm;
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <div class="modal-title">
        <?= \yii\bootstrap\Html::encode($title)?>
    </div>
</div>
<?php $form= ActiveForm::begin([
    'id' => 'buying-form',        
    'enableClientValidation' => true, 
    'enableAjaxValidation' => false,
    'options' => ['enctype' => 'multipart/form-data']
])?>
<div class="modal-body">
        <?php 
            $items = yii\helpers\ArrayHelper::map(app\models\Fruit::find()->all(), 'id', 'name');
        ?>
 
        <?php 
            echo $form->field($model, 'fruit_id')->widget(kartik\select2\Select2::classname(), [
            'data' => $items,
            'language' => 'th',
            'options' => ['placeholder' => 'เลือกผลไม้'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);        
        ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'amount')->textInput(['type'=>'number', 'id'=>'txtAmount'])?> 
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'price')->textInput(['type'=>'number', 'id'=>'txtPrice'])?> 
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'total')->textInput(['type'=>'number', 'id'=>'txtTotal'])?> 
            </div>
        </div>
        <?= $form->field($model, 'location')->textarea(['placeholder'=>'เช่น บ้านไร่ม่วง']); ?>
        <?= $form->field($model, 'status')->inline()->radioList(['1'=>'เพิ่มผลไม้ลงในสต๊อกผลไม้','2'=>'ยังไม่เพิ่มผลไม้ลงในสต๊อกผลไม้'])->label(FALSE)?>
    <div>
        <label style="color:red">*หมายเหตุ ถ้าคุณติ๊กที่ เพิ่มผลไม้ลงในสต๊อกผลไม้ คุณจะไม่สามารถแก้ไข หรือ ลบ รายการสั่งซื้อผลไม้ได้</label>
    </div>
</div>

<div class="modal-footer">
    <?= yii\helpers\Html::submitButton('<i class="fa fa-save"></i> บันทึก', ['class'=>'btn btn-success','id'=>'btnSave'])?>
</div>
<?php ActiveForm::end();?> 
<?php
$this->registerJs("
    $('#buying-form').on('beforeSubmit', function(e) {
      
        let form = \$(this);
        let formData = form.serialize();
         
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {console.log(data);
                   if(data.status == 'success'){
                   ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
                   $('#modal-fruit').modal('hide');
                   initFruit('');
                    }
                },
                error: function (err) {
                   console.log(err);
                }
            }); 
         

    }).on('submit', function(e){
        e.preventDefault();
    });
    
    $('#txtAmount').change(function(){
        let amount = $(this).val();
        let price = $('#txtPrice').val();
        let total = $('#txtTotal').val();
        
        total = amount * price;
        
        $('#txtTotal').val(total);
        return false;
    });
    $('#txtPrice').change(function(){
        let price = $(this).val();
        let amount = $('#txtAmount').val();        
        let total = $('#txtTotal').val();
        total = (amount * price);        
        $('#txtTotal').val(total);
        return false;
    });
    $('#buying-fruit_id').change(function(){
        let fruit_id = $(this).val();
        let url = '".\yii\helpers\Url::to(['/buying/get-fruit'])."';
        $.get(url, {id:fruit_id},function(data){
            //console.log(data.price);
            $('#txtPrice').val(data.price);
        });
        return false;
    })

");
?>