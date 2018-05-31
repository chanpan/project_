<?php

namespace app\models;
 
use yii\base\Model;
 
class Upload extends Model
{
    public $image;
    
    public function rules()
    {
        return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->image as $file) {
                $fileName = Date('YmdHis').time(). rand(9999, 99999999) . '.' . $file->extension; 
                if($file->saveAs('uploads/' . $fileName)){
                    \Yii::$app->db->createCommand()->insert('upload', [
                        'name'=>$fileName,
                        'create_at'=>Date('Y-m-d')
                    ])->execute();
                }
                 
                 
 
            }
            return true;
        } else {
            return false;
        }
    }

    
}
