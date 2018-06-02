<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'การขาย';

?>
<div class="sell-index">

    <h1><?= Html::encode($this->title) ?></h1>
 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'รหัสการสั่งซื้อ',
                'value'=>function($model){
                    return $model->order_id;
                }
            ],
            [
                'label'=>'ผู้บันทึก',
                'value'=>function($model){
                    return $model->users->name;
                }
            ],
            [
                'label'=>'ลูกค้า',
                'value'=>function($model){
                    return $model->members->name;
                }
            ],
            [
                'label'=>'วันที่ขาย',
                'value'=>function($model){
                    return $model->date;
                }
            ],

          [
            'contentOptions'=>['style'=>'text-align:center;width:150px;'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',  // the default buttons + your custom button
            'buttons' => [
                'update'=>function($url, $model, $key){
                    return \yii\bootstrap\Html::a("<i class='fa fa-edit'></i> แก้ไข", \yii\helpers\Url::to(['/sell/update', 'id'=>$model['id']]), ['data-action'=>'update','class'=>'btn btn-sm btn-info']);
                },
                'delete'=>function($url, $model, $key){
                    if($model['id'] != cpn\lib\classes\CNCheckLogin::getUserId()){
                        return \yii\bootstrap\Html::a("<i class='fa fa-trash'></i> ลบ", \yii\helpers\Url::to(['/sell/delete', 'id'=>$model['id']]), ['data-action'=>'delete','class'=>'btn btn-sm btn-danger']);
                    }
                }        
            ]
        ]
        ],
    ]); ?>
</div>
<?php
 yii\bootstrap\Modal::begin([
    'id' => 'modal-sell',    
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
]);
yii\bootstrap\Modal::end();
?> 
<?php

$this->registerJs("
    $('.btn').on('click',function(e){
        let actions = $(this).attr('data-action');
        let url = $(this).attr('href');
         
        if(actions == 'update'){
           $('#modal-sell .modal-content').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');
           $.get(url,function(data){
                $('#modal-sell .modal-content').html(data);
                $('#modal-sell').modal('show');
           });
        }
        if(actions == 'delete'){
          yii.confirm('คุณต้องการลบการขายนี้หรือไม่', function(){
              $.get(url,function(data){console.log(data);return false;
                if(data.status=='success'){
                    ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
                    
                }else{
                    ".\cpn\lib\classes\CNNoty::Error('data.title', 'data.message').";
                }
                setTimeout(function(){
                    location.reload();
                },1000);
              });
	  });
        }
        return false;
    });
    
 
   
");
?>