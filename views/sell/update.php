<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sell */

$this->title = 'Update Sell: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sells', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sell-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
