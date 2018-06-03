<?php
    $this->title="เอกสาร";
    use yii\helpers\Url;
?>
<div class="panel panel-default">
    <div class="panel-heading"><?= yii\bootstrap\Html::encode($this->title)?></div>
    <div class="panel-body">
        <div>
            <ul>
                <li><a href="<?= Url::to('@web/doc/edit/1.docx')?>">บทที่ 1-2</a> </li>
                <li><a href="<?= Url::to('@web/doc/edit/3.docx')?>">บทที่ 3</a> </li>
                <li><a href="<?= Url::to('@web/doc/edit/4.docx')?>">บทที่ 4</a> </li>
                <li><a href="<?= Url::to('@web/doc/edit/5.docx')?>">บทที่ 5</a> </li>
                <li><a href="<?= Url::to('@web/doc/edit/home.docx')?>">หน้าปก</a></li>
                <li><a href="<?= Url::to('@web/doc/edit/a.docx')?>">หน้า ก</a></li>
                <li><a href="<?= Url::to('@web/doc/edit/sarabun.docx')?>">สารบัญ</a></li>
            </ul>
        </div>
    </div>
</div>
