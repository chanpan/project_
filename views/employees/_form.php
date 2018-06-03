<?php
    use yii\bootstrap\ActiveForm;
?>
<div class="col-md-6 col-md-offset-3">
<?php $form = ActiveForm::begin()?>
    <?= $form->field($model, 'cid')->textInput(); ?>
    <?= $form->field($model, 'name')->textInput(); ?>
    <?= $form->field($model, 'address')->textarea(); ?>
    <?= $form->field($model, 'tel')->textInput(); ?> 
    <?= \yii\bootstrap\Html::submitButton("บันทึก", ['class'=>'btn btn-primary'])?>
<?php ActiveForm::end()?>
</div>