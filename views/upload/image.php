<?php
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
?>

<?php $form= ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<div class="col-md-8">
    <?= $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'class'=>'form-control'])->label(FALSE) ?>
</div>
<div class="col-md-4">
    <?= Html::submitButton("Upload", ['class'=>'btn btn-success'])?>
</div>
<div class="clearfix"></div>
<?php ActiveForm::end()?>

<?php if(!empty($dataImage)): ?>
    <hr/>
    <div class="row">
        <?php foreach($dataImage as $k=>$v){?>
        <div class="col-md-2" style="margin-top:30px">
            <img class="img img-thumbnail img-responsive" style="width:100%;height:100%;" src="<?= Yii::getAlias('@web').'/uploads/'.$v['name']?>"/>
            <button class="btn btn-danger btn-block btn-sm"><i class="fa fa-trash"></i> Delete</button>
        </div>
        <?php }?>
    </div>
<?php endif; ?>