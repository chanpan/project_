<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property int $cid
 * @property string $name
 * @property string $address
 * @property string $tel
 * @property int $wage
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'name', 'address', 'tel', 'wage'], 'required'],
            [['cid', 'wage'], 'integer'],
            [['address'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['tel'], 'string', 'max' => 10],
            [['cid'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'หมายเลขบัตรประชาชน',
            'name' => 'ชื่อนามสกุล',
            'address' => 'ที่อยู่',
            'tel' => 'เบอร์โทรศัพท์',
            'wage' => 'ค่าจ้างต่อวัน',
        ];
    }
}
