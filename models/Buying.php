<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buying".
 *
 * @property int $id
 * @property int $fruit_id
 * @property int $user_id
 * @property int $amount
 * @property int $price
 * @property int $total
 */
class Buying extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buying';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fruit_id', 'user_id', 'amount', 'price', 'total','location','status'], 'required'],
            [['fruit_id', 'user_id', 'amount', 'price', 'total'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fruit_id' => 'ชื่อผลไม้',
            'user_id' => 'ชื่อผู้ใช้',
            'amount' => 'จำวนวน/กก.',
            'price' => 'ราคา/กก.',
            'total' => 'ราคารวม',
            'location'=>'สถานที่ไปซื้อ',
            'date'=>'วันที่ไปซื้อ'
        ];
    }
}
