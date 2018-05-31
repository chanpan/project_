<?php
    use yii\bootstrap\Modal;
    $this->title = "รับซื้อผลไม้";
?>
<?php 
    //echo yii\bootstrap\Modal::$stack
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left"><?= \yii\bootstrap\Html::encode($this->title)?></div>
                                <div class="pull-right"><?= \yii\bootstrap\Html::button('<i class="fa fa-plus"></i> เพิ่ม', ['id'=>'btnCreate','class'=>'btn btn-sm btn-success', 'data-url'=> \yii\helpers\Url::to(['/buying/create'])])?></div>
                            </div>
                        </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        
        <div class="col-md-6" style="padding: 0;margin-bottom: 20px;">
            <div class="input-group">
                <input type="text" class="form-control" id="txtSearch" placeholder="ค้นหา ชื่อผลไม้">
                <span class="input-group-btn">
                    <button id="btnSearch" class="btn btn-default" type="button"><i class="fa fa-search"></i> ค้นหา</button>
                </span>
            </div><!-- /input-group -->
        </div><div class="clearfix"></div>
        
        <div class="table-responsive">            
            <div id="view-fruit"></div>
        </div>
    </div>
</div>

<?php
Modal::begin([
    'id' => 'modal-fruit',    
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
    'options'=>[
        'tabindex' => false
    ]
]);
Modal::end();
?>        

<?php 
$this->registerJs("
     initFruit=function(search){
        let url = '" . \yii\helpers\Url::to(['/buying/get-buying']) . "';
        $('#view-fruit').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');    
        $.get(url,{search:search},function(data){
            $('#view-fruit').html(data);
        }).fail(function(err){
            $('#view-fruit').html('เกิดข้อผิดพลาดบน server ระบบจะ รีเฟรชใหม่ในอีก 5 วินาที');
            
        });
     }
     
    sortFruit=function(url){        
        $('#view-fruit').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');    
        $.get(url,{search:''},function(data){
            $('#view-fruit').html(data);
        }).fail(function(err){
            $('#view-fruit').html('เกิดข้อผิดพลาดบน server ระบบจะ รีเฟรชใหม่ในอีก 5 วินาที');
            setTimeout(function(){
               location.reload();
            }, 5000);
        });
     }
     initFruit('');
     

    $('#btnSearch').click(function(){
            let search = $('#txtSearch').val();             
            initFruit(search);             
            return false;
    });
    $('#btnCreate').on('click',function(e){
         let url = $(this).attr('data-url');          
         $('#modal-fruit .modal-content').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');
           $.get(url,function(data){
                $('#modal-fruit .modal-content').html(data);
                $('#modal-fruit').modal('show');
           });
        return false;
    });
");
?>
