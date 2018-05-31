<div id="name">Nuttaphon Chanpan</div>
<button id="btnChange" class="btn btn-primary">Change name</button>

<?php
    $this->registerJs("
        $('#btnChange').click(function(){
            let url = '/test/index2';
            $.ajax({
                url:url,
                success:function(data){
                    $('#name').text(data);
                }
            });
        });
    ");
?>

 