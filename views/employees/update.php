<?php 
    $this->title="แก้ไข ข้อมูลพนักงาน";
?>
<h2><?= $this->title;?></h2>
<?php 
    echo $this->render("_form",["model"=>$model]);
?>