<?php

/**
 * 这个是用户输入的数据
 */
namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * 这个地方会影响form的label显示
     * @return array
     */
    public function attributeLabels()
    {
        return [
          'name'=>"高步的",
            'email'=>'好好的'
        ];
    }

//    public function attributes()
//    {
//
//    }
}