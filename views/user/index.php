<?php
    use yii\bootstrap\Modal;
    $this->title = "ผู้ใช้";
?>
<?php 
    //echo yii\bootstrap\Modal::$stack
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <label><?= \yii\bootstrap\Html::encode($this->title)?></label>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" id="txtSearch" placeholder="ค้นหา ชื่อผู้ใช้ , ชื่อ-นามสกุล">
                <span class="input-group-btn">
                    <button id="btnSearch" class="btn btn-default" type="button"><i class="fa fa-search"></i> ค้นหา</button>
                </span>
            </div><!-- /input-group -->
        </div>
        <div class="col-md-12">
            <div class="table-responsive">            
                <div id="view-user"></div>
            </div>
        </div>
        
    </div>
</div>

<?php
Modal::begin([
    'id' => 'modal-user',    
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
]);
Modal::end();
?>        

<?php 
$this->registerJs("
     initUser=function(search){
        let url = '".\yii\helpers\Url::to(['/user/get-user'])."';
        $('#view-user').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');    
        $.get(url,{search:search},function(data){
            $('#view-user').html(data);
        });
     }
     initUser('');
     sortUser=function(url){        
        $('#view-user').html('<div class=\'text-center\'><i class=\"fa fa-spinner fa-pulse fa-3x fa-fw\"></i></div>');    
        $.get(url,{search:''},function(data){
            $('#view-user').html(data);
        });
     }

    $('#btnSearch').click(function(){
        let search = $('#txtSearch').val();               
        initUser(search);             
        return false;
    });
");
?>
