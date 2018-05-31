<?php ?>
<div class="panel panel-default">
    <div class="panel-heading">รายงานการขาย</div>
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
                    <th>วันที่ขาย</th>
                    <th>สินค้าที่ขาย</th>
                    <th>จำนวน</th>
                    <th>ลูกค้า</th>
                    <th>ราคา</th>
                    <th>ราคารวม</th>
                    <th>สถานที่จัดส่ง</th>
                </tr>
            </thead>
            <tbody> 
<?php if (!empty($data)) { ?>
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td><?= $d['date'] ?></td>
                            <td><?= $d['pro_name'] ?></td>
                            <td><?= $d['amount'] ?></td>
                            <td><?= $d['name'] ?></td>
                            <td><?= $d['prict'] ?></td>
                            <td><?= $d['total'] ?></td>
                            <td><?= $d['locations'] ?></td>
                        </tr>
    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>