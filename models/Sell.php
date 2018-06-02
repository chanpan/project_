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
            [['order_id', 'user_id', 'mem_id'], 'required'],
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
            'order_id' => 'OrderID',
            'user_id' => 'ผู้บันทึก',
            'mem_id' => 'ชื่อลูกค้า',
            'fruit_id' => 'Fruit ID',
            'amount' => 'Amount',
            'price' => 'Price',
            'total' => 'Total',
            'date' => 'วันที่ขาย',
        ];
    }
    public  function getUsers(){
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
    public  function getMembers(){
        return $this->hasOne(Users::className(), ['id' => 'mem_id']);
    }
}
