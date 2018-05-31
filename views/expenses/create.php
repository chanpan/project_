<?php 
    $this->title="เพิ่มค่าใช้จ่าย";
?>
<h2><?= $this->title;?></h2>
<?php 
    echo $this->render("_form",["model"=>$model]);
?>