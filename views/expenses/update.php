<?php 
    $this->title="แก้ไขค่าใช้จ่าย";
?>
<h2><?= $this->title;?></h2>
<?php 
    echo $this->render("_form",["model"=>$model]);
?>