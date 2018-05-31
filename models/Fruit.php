<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fruit".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $amount
 * @property int $price
 */
class Fruit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fruit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'amount', 'price','total'], 'required'],
            [['amount', 'price','sale_price'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อผลไม้',
            'image' => 'รูปภาพ',
            'amount' => 'จำนวน(กก.)',
            'price' => 'ราคาซื้อ/กก.',
            'total' => 'ราคารวม',
            'sale_price' => 'ราคาขาย/กก.',
        ];
    }
}
