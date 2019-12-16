<?php
namespace common\models;

use Yii;
use yii\base\Model;

class Lesson extends \yii\db\ActiveRecord
{

    public static function TableName()
    {
        return 'lesson';
    }

    public function rules()
    {
        return [
			[['id', 'id_course'], 'integer'],
			[['lect', 'audio', 'pract'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'id_course' => 'Название курса',
            'lect' => 'Файлы лекций',
			'audio' => 'Файлы аудио',
			'pract' => 'Файлы практических занятий',
        ];
    }
	
}