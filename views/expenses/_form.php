<?php
    use yii\bootstrap\ActiveForm;
?>
<div class="col-md-6 col-md-offset-3">
<?php $form = ActiveForm::begin()?>
    <?= $form->field($model, 'name')->textInput(); ?>
    <?php 
            $items = yii\helpers\ArrayHelper::map(app\models\Employee::find()->all(), 'id', 'name');
        ?>
 
        <?php 
            echo $form->field($model, 'emp_id')->widget(kartik\select2\Select2::classname(), [
            'data' => $items,
            'language' => 'th',
            'options' => ['placeholder' => 'เลือกพนักงาน'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('ชื่อพนักงาน');        
        ?>
    <?= $form->field($model, 'amount')->textInput(); ?>
    <?= \yii\bootstrap\Html::submitButton("บันทึก", ['class'=>'btn btn-primary'])?>
<?php ActiveForm::end()?>
</div>