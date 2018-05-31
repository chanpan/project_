<?php
    
?>
<h1>Update SQL</h1>

<textarea id="txtSql" class="form-control" rows="5" placeholder="ALTER TABLE `fruit`
DROP COLUMN `sale_price`,
ADD COLUMN `sale_price`  int(11) NULL AFTER `total`;"></textarea><br>
<button id="btnUpdateSql" class="btn btn-success">Run</button>

<?php 
    $this->registerJs("
        $('#btnUpdateSql').click(function(){
            let txtSql = $('#txtSql').val();
            let url = '".yii\helpers\Url::to(['/site/update-sql'])."';
            $.post(url, {txtSql:txtSql},function(data){
                ".\cpn\lib\classes\CNNoty::Success('data.title', 'data.message').";
            });
            return false;
        });
    ");

?>