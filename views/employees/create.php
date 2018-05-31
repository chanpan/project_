<?php 
    $this->title="เพิ่ม ข้อมูลพนักงาน";
?>
<h2><?= $this->title;?></h2>
<?php 
    echo $this->render("_form",["model"=>$model]);
?>