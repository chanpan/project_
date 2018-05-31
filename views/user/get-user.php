<?=

\yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['id'=>'tables','class' => 'table table-hover table-bordered table-responsive'],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ],
        [
            'attribute' => 'username',
            'label' => 'ชื่อผู้ใช้',
            'value' => 'username'
        ],
        [
            'attribute' => 'name',
            'label' => 'ชื่อ-นามสกุล',
            'value' => 'name'
        ],
        [
            'attribute' => 'email',
            'label' => 'อีเมล',
            'value' => 'email'
        ],
        [
            'attribute' => 'tel',
            'label' => 'เบอร์โทรศัพท์',
            'value' => 'tel'
        ],
        [
            'attribute' => 'sex',
            'label' => 'เพศ',
            'value' => function($model) {
                if ($model['sex'] == '1') {
                    return 'ชาย';
                } else {
                    return 'หญิง';
                }
            }
        ],
        [
            'attribute' => 'role',
            'label' => 'บทบาท',
            'value' => 'role'
        ],
         [
            'contentOptions'=>['style'=>'text-align:center;width:150px;'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',  // the default buttons + your custom button
            'buttons' => [
                'update'=>function($url, $model, $key){
                    return \yii\bootstrap\Html::a("<i class='fa fa-edit'></i> แก้ไข", \yii\helpers\Url::to(['/user/update', 'id'=>$model['id']]), ['data-action'=>'update','class'=>'btn btn-sm btn-info']);
                },
                'delete'=>function($url, $model, $key){
                    if($model['id'] != cpn\lib\classes\CNCheckLogin::getUserId()){
                        return \yii\bootstrap\Html::a("<i class='fa fa-trash'></i> ลบ", \yii\helpers\Url::to(['/user/delete', 'id'=>$model['id']]), ['data-action'=>'delete','class'=>'btn btn-sm btn-danger']);
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
           $('#modal-user .modal-content').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');
           $.get(url,function(data){
                $('#modal-user .modal-content').html(data);
                $('#modal-user').modal('show');
           });
        }
        if(actions == 'delete'){
          yii.confirm('คุณต้องการลบผู้ใช้นี้หรือไม่', function(){
              $.get(url,function(data){
                if(data.status=='success'){
                    ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
                    initUser('');    
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
        sortUser(url);
        return false;
         
    });
    
   
");
?>