<?php
namespace common\models;

use Yii;

class Course extends \yii\db\ActiveRecord
{
    public $stats;

    public static function TableName()
    {
        return 'stats';
    }

    public function rules()
    {
        return [
			[['id'],['active'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['text'], 'string'],
			[['little_text'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название курса',
			'text' => 'Описание курса',
			'little_text' => 'Краткое описание курса',
            'active' => 'Состояние активности',
        ];
    }
}