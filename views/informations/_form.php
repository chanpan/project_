<?php
    use yii\bootstrap\ActiveForm;
?>
<div class="col-md-6 col-md-offset-3">
<?php $form = ActiveForm::begin()?>
    <?= $form->field($model, 'title')->textInput(); ?>
    <?= $form->field($model, 'detail')->textarea(['rows'=>7]); ?>
    <?= \yii\bootstrap\Html::submitButton("บันทึก", ['class'=>'btn btn-primary'])?>
<?php ActiveForm::end()?>
</div>