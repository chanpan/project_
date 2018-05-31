<?php

use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
$this->title = "ประชาสัมพันธ์";
?>
<div class="col-md-12">
    <h2><?= $this->title?></h2>
</div>
<?php
    ActiveForm::begin([
        'method' => 'get',
        //'action' => ['informations/index'],
    ])
?>
<div class="col-lg-6">
    <div class="input-group">

        <input type="text" name="search" class="form-control" placeholder="ค้นหา">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
        </span>

    </div><!-- /input-group -->
</div><!-- /.col-lg-6 -->
<?php ActiveForm::end() ?>
<div class="col-md-6 text-right">
    <a class="btn btn-success" href="<?= yii\helpers\Url::to(['/informations/create']) ?>"><i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล</a>
</div>
<div class="col-md-12">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'detail',
            'date',
            [
                'attribute'=>'user_id',
                'value'=>'users.username'
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}']
        ],
    ])
    ?>
</div>
