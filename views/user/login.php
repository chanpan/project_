 <?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
?>
<div class=" ">
 
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        
        'enableClientValidation' => true, 
        'enableAjaxValidation' => false,
        
    ]); ?>
 
    
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
               
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sign in
                    </div>
                    <div class="panel-body">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'Username']) ?>
                        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password']) ?>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-lg btn-warning btn-block" type="submit">Sign in</button>
                    </div>
                </div>
                <a href="<?= \yii\helpers\Url::to(['/user/register'])?>" class="text-center new-account">สมัครสมาชิก </a>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php 
$this->registerJs("
$('#login-form').on('beforeSubmit', function(e) {
    let form = \$(this);
    let formData = form.serialize();
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: formData,
        success: function (data) {
            if(data.status == 'success'){                 
                location.href = '".\yii\helpers\Url::to(['/site/index'])."';    
            }
            else if(data.status == 'error'){
                ".\cpn\lib\classes\CNNoty::Error('data.title', 'data.message').";                
            }
            
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
