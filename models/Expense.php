<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $emp_id
 * @property int $amount
 * @property string $date
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'emp_id', 'amount'], 'required'],
            [['user_id', 'emp_id', 'amount'], 'integer'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อรายการ',
            'user_id' => 'ผู้บันทึก',
            'emp_id' => 'รหัสพนักงาน',
            'amount' => 'จำนวนเงิน',
            'date' => 'วันที่',
        ];
    }
    public  function getUsers(){
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
