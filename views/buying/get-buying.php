<?=

\yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['id'=>'tables','class' => 'table table-hover table-bordered table-responsive'],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ],
        [
            'format'=>'raw',
            'attribute' => 'image',
            'label' => 'รูปภาพ',
            'value' => function($model){
                return yii\bootstrap\Html::img(Yii::getAlias('@web').'/uploads/'.$model['image'], ['class'=>'img img-responsive', 'style'=>'width:100px']);
            }
        ],
        [
            'attribute' => 'name',
            'label' => 'ชื่อผลไม้',
            'value' => 'name'
        ],
        [
            'attribute' => 'amount',
            'label' => 'จำนวน/กก.',
            'value' => 'amount'
        ],
        [
            'attribute' => 'price',
            'label' => 'ราคา/กก.',
            'value' => 'price'
        ],
        [
            'attribute' => 'total',
            'label' => 'ราคารวม',
            'value' => 'total'
        ],
        [
          'attribute' => 'uname',
           'label' => 'บันทึกโดย',
           'value' => 'uname'
        ],
                [
        'attribute' => 'date',
           'label' => 'วันที่ไปซื้อ',
           'value' => 'date'
        ],
   
         [
            'contentOptions'=>['style'=>'text-align:center;width:150px;'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',  // the default buttons + your custom button
            'buttons' => [
                'update'=>function($url, $model, $key){
                    if($model['status'] == 2){
                        return \yii\bootstrap\Html::a("<i class='fa fa-edit'></i> แก้ไข", \yii\helpers\Url::to(['/buying/update', 'id'=>$model['id']]), ['data-action'=>'update','class'=>'btn btn-sm btn-info']);
                    }else{
                        return "<label class='label label-success'>ผลไม้ถูกคำนวณลงในสต๊อกแล้ว</label>";
                    }                    
                },
                'delete'=>function($url, $model, $key){
                    if($model['status'] == 2){
                        return \yii\bootstrap\Html::a("<i class='fa fa-trash'></i> ลบ", \yii\helpers\Url::to(['/buying/delete', 'id'=>$model['id']]), ['data-action'=>'delete','class'=>'btn btn-sm btn-danger']);
                    }
                }        
            ]
        ]
    ],
])
?>

<?php

$this->registerJs("
    $('.btn').on('click',function(e){
        let actions = $(this).attr('data-action');
        let url = $(this).attr('href');
         
        if(actions == 'update'){
           $('#modal-fruit .modal-content').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');
           $.get(url,function(data){
                $('#modal-fruit .modal-content').html(data);
                $('#modal-fruit').modal('show');               
           });
        }
        if(actions == 'delete'){
          yii.confirm('คุณต้องการลบลบรายการสั่งซื้อผลไม้นี้หรือไม่', function(){
              $.get(url,function(data){
                if(data.status=='success'){
                    ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
                    initFruit('');    
                }else{
                    ".\cpn\lib\classes\CNNoty::Error('data.title', 'data.message').";
                }
              });
	  });
        }
        return false;
    });
    
    $('#tables thead tr th a , .pagination li a').click(function(){
        let url = $(this).attr('href');
        sortFruit(url);
        return false;
         
    });
    
   
");
?>