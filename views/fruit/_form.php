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
    'id' => 'fruit-form',        
    'enableClientValidation' => true, 
    'enableAjaxValidation' => false,
    'options' => ['enctype' => 'multipart/form-data']
])?>
<div class="modal-body">
        <?= $form->field($model, 'name')->textInput()?>
        <?= $form->field($model, 'image')->fileInput()?>
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
            <div class="col-md-4">
                <?= $form->field($model, 'sale_price')->textInput(['type'=>'number', 'id'=>'sale_price'])?> 
            </div>
            
        </div> 
</div>

<div class="modal-footer">
    <?= yii\helpers\Html::submitButton('<i class="fa fa-save"></i> บันทึก', ['class'=>'btn btn-success','id'=>'btnSave'])?>
</div>
<?php ActiveForm::end();?> 
<?php
$this->registerJs("
    $('#fruit-form').on('beforeSubmit', function(e) {
      
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
");
?>