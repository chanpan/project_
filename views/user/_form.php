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
    'id' => 'user-form',        
    'enableClientValidation' => true, 
    'enableAjaxValidation' => false,
])?>
<div class="modal-body">
        <?= $form->field($model, 'email')->textInput()?>
        <?= $form->field($model, 'name')->textInput()?>
        <?= $form->field($model, 'sex')->inline()->radioList(['1'=>'ชาย','2'=>'หญิง'])?>
        <?= $form->field($model, 'tel')->textInput()?>
        <?= $form->field($model, 'role')->inline()->radioList(['admin'=>'ผู้ดูแลระบบ','user'=>'ผู้ใช้'])?>
</div>

<div class="modal-footer">
    <?= \yii\bootstrap\Html::submitButton('<i class="fa fa-save"></i> บันทึก', ['class'=>'btn btn-success'])?>
</div>
<?php ActiveForm::end();?> 
<?php
$this->registerJs("
    $('#user-form').on('beforeSubmit', function(e) {
        let form = \$(this);
        let formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            success: function (data) {
               ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
               $('#modal-user').modal('hide');
               initUser('');
            },
            error: function (err) {
               console.log(err);
            }
        }); 

    }).on('submit', function(e){
        e.preventDefault();
    });
");
?>