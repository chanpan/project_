<?php ?>
<div class="panel panel-default">
    <div class="panel-heading">รายงานค่าใช้จ่าย</div>
    <div class="panel-body">
        <div style="margin-bottom:10px;">
<?php yii\bootstrap\ActiveForm::begin(['action' => '/report/sell', 'method' => 'get']); ?>
            <label>จากวันที่</label>
            <?= \yii\bootstrap\Html::input('date', 'date1') ?>
            <label>ถึง</label>
            <?= \yii\bootstrap\Html::input('date', 'date2') ?>
            <?= \yii\bootstrap\Html::submitButton('ค้าหา', ['class' => 'btn btn-primary']) ?>
            <?php yii\bootstrap\ActiveForm::end(); ?>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>วันที่</th>
                    <th>รายการ</th>                    
                    <th>ชื่อพนักงาน</th>
                    <th>จำนวนเงิน/ต่อวัน</th>
                </tr>
            </thead>
            <tbody> 
<?php if (!empty($data)) { ?>
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td><?= $d['date'] ?></td>
                            <td><?= $d['e_name'] ?></td>
                            <td><?= $d['name'] ?></td>
                            <td><?= $d['amount'] ?></td> 
                        </tr>
    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>