<?php

namespace app\models;

use Yii;

class UserForm extends \yii\base\Model {
    public $username, $password;
    public function rules() {
        return [
            [['username', 'password'], 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

}