<?php

?>
<div class="panel panel-default">
    <div class="panel-heading">ผลไม้ล่าสุด</div>
    <div class="panel-body">
        <?php if(!empty($model)){?>
        <?php foreach($model as $m){?>
        
            <div class="media">
            <div class="media-left">
              <a href="/fruit">
                  <img class="media-object" src="<?= Yii::getAlias('@web').'/uploads/'.$m['image']?>" style="width:100px;">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading"><?= $m['name']?></h4>
              <p>จำนวนำ/เหลือ : <?= $m['amount']?> กก.</p>
            </div>
          </div>
        <?php }?>
        <?php }?>
    </div>
</div>