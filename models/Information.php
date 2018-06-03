<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "information".
 *
 * @property int $id
 * @property string $title
 * @property string $detail
 * @property int $user_id
 * @property string $date
 */
class Information extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'detail'], 'required'],
            [['detail'], 'string'],
            [['user_id'], 'integer'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ไตเติ้ล',
            'detail' => 'รายละเอียด',
            'user_id' => 'ผู้ประกาศ',
            'date' => 'วันที่',
        ];
    }
    public  function getUsers(){
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
