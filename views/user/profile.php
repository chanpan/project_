<?php
    use yii\bootstrap\ActiveForm;
    $this->title = "โปรไฟล์";
?>

 
<?php $form= ActiveForm::begin([
    'id' => 'user-form',        
    'enableClientValidation' => true, 
    'enableAjaxValidation' => false,
])?>
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading"><?= \yii\bootstrap\Html::encode($this->title)?></div>
        <div class="panel-body">
                <?= $form->field($model, 'email')->textInput()?>
                <?= $form->field($model, 'username')->textInput()?>
                <?= $form->field($model, 'password')->passwordInput()?>
                <?= $form->field($model, 'name')->textInput()?>
                <?= $form->field($model, 'sex')->inline()->radioList(['1'=>'ชาย','2'=>'หญิง'])?>
                <?= $form->field($model, 'tel')->textInput()?>

        </div>

        <div class="panel-footer">
            <?= \yii\bootstrap\Html::submitButton('<i class="fa fa-save"></i> Save', ['class'=>'btn btn-success'])?>
        </div>
    </div>
</div>
<?php ActiveForm::end();?> 
<?php
$this->registerJs("
     $('#user-form').on('beforeSubmit', function(e) {
            let form = \$(this);
            let formData = form.serialize();
            yii.confirm('คุณต้องการแก้ไขโปรไฟล์หรือไม่', function(){
                 $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: formData,
                        success: function (data) {
                           " . \cpn\lib\classes\CNNoty::Success('data.title', 'data.message') . ";
                           $('#modal-user').modal('hide');
                           initUser('');
                        },
                        error: function (err) {
                           console.log(err);
                        }
                    });
            });
    }).on('submit', function(e){
            e.preventDefault();
    });
    
    
");
?>