<?php
    use yii\bootstrap\ActiveForm;
    $this->title = 'แกไขการขาย';
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <div class="modal-title">
        <b><?= \yii\bootstrap\Html::encode($this->title)?></b>
    </div>
</div>
<?php $form= ActiveForm::begin([
    'id' => 'user-form',        
    'enableClientValidation' => true, 
    'enableAjaxValidation' => false,
])?>
<div class="modal-body">
        <?= $form->field($model, 'order_id')->textInput()?>        
        <?= $form->field($model, 'mem_id')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Users::find()->all(), 'id', 'name'))?>
       
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
               $('#modal-sell').modal('hide');
               setTimeout(function(){
                    location.href='/sell/index';
                },1000);
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