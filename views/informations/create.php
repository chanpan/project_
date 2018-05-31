<?php 
    $this->title="เพิ่มประชาสัมพันธ์";
?>
<h2><?= $this->title;?></h2>
<?php 
    echo $this->render("_form",["model"=>$model]);
?>