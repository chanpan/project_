<?php 
    $this->title = "รายงาน";
?>
<div>
    <h3>รายงาน</h3>
</div>
<div class="row">
    <div>
        <div class="col-md-3">
            <label>จากวันที่</label>
            <input type="date" id="stDate" class="form-control"/>
        </div>
         <div class="col-md-3">
            <label>ถึงวันที่</label>
            <input type="date" id="enDate" class="form-control"/>
        </div>
        <div class="col-md-3">             
            <button style="margin-top:25px;" id="btnCreateReport" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> สร้างรายงาน</button>
            <button style="margin-top:25px;display: none;" id="btnPrintReport" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> พิมพ์</button>
        </div>
    </div>
</div>

<div id="showReport"></div>

<?php 
$this->registerJs("
    $('#btnCreateReport').click(function(){
        let stDate = $('#stDate').val();
        let enDate = $('#enDate').val();
        let url = '".\yii\helpers\Url::to(['/report/default/get-report'])."';
        let params = {stDate:stDate, enDate:enDate, status:2};        
        $.ajax({
            url:url,
            type:'GET',
            data:params,
            success:function(result){
               $('#showReport').html(result);
               $('#btnPrintReport').show();
            }
        });
        return false;
    });
    

    $('#btnPrintReport').click(function(){
        let stDate = $('#stDate').val();
        let enDate = $('#enDate').val();
        let url = '".\yii\helpers\Url::to(['/report/default/get-report/'])."';
        url +='?stDate='+stDate+'&enDate='+enDate+'&status=1';
        location.href = url;
        return false;
    });
");
?>