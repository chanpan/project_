<?php
    use yii\bootstrap\ActiveForm;
    $this->title="สมัครสมาชิก";
?>
<?php $form= ActiveForm::begin([
    'id' => 'user-register',        
    'enableClientValidation' => true, 
    'enableAjaxValidation' => false,
])?>
<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= \yii\bootstrap\Html::encode($this->title) ?>
        </div>

        <div class="panel-body">
            <?= $form->field($model, 'email')->textInput() ?>
            <?= $form->field($model, 'username')->textInput() ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'sex')->inline()->radioList(['1' => 'ชาย', '2' => 'หญิง']) ?>
            <?= $form->field($model, 'tel')->textInput() ?>
        </div>

        <div class="panel-footer">
            <div class="text-right">
                <?= \yii\bootstrap\Html::submitButton('ยืนยัน', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end();?> 
<?php
$this->registerJs("
    $('#user-register').on('beforeSubmit', function(e) {
        let form = \$(this);
        let formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            success: function (data) {
               ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
               $('#modal-user').modal('hide');
               location.href='".\yii\helpers\Url::to(['/user/login'])."';
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