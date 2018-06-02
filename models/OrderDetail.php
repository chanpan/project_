<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property int $id
 * @property int $order_id
 * @property int $pro_id
 * @property string $pro_name
 * @property int $amount
 * @property int $prict
 * @property int $total
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'pro_id', 'pro_name', 'amount', 'prict', 'total'], 'required'],
            [['order_id', 'pro_id', 'amount', 'prict', 'total','user_id'], 'integer'],
            [['pro_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'pro_id' => 'Pro ID',
            'pro_name' => 'Pro Name',
            'amount' => 'Amount',
            'prict' => 'Prict',
            'total' => 'Total',
            'user_id'=>'UserId'
        ];
    }
}
