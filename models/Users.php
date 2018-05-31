<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $name
 * @property string $tel
 * @property string $sex
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tel', 'sex','email','role','username','password'], 'required'],
            [['email', 'username', 'password'], 'string', 'max' => 100],
            [['role'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['tel', 'sex'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'อีเมล',
            'username' => 'ชื่อผู้ใช้',
            'password' => 'รหัสผ่าน',
            'role' => 'บทบาท',
            'name' => 'ชื่อ-นามสกุล',
            'tel' => 'เบอร์โทรศัพท์',
            'sex' => 'เพศ',
        ];
    }
}
