<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sell".
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id User ที่ login
 * @property int $mem_id
 * @property int $fruit_id
 * @property int $amount
 * @property int $price
 * @property int $total
 * @property string $date
 */
class Sell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'mem_id', 'fruit_id', 'amount', 'price', 'total', 'date'], 'required'],
            [['order_id', 'user_id', 'mem_id', 'fruit_id', 'amount', 'price', 'total'], 'integer'],
            [['date'], 'safe'],
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
            'user_id' => 'User ที่ login',
            'mem_id' => 'Mem ID',
            'fruit_id' => 'Fruit ID',
            'amount' => 'Amount',
            'price' => 'Price',
            'total' => 'Total',
            'date' => 'Date',
        ];
    }
}
