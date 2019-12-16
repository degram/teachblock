<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User_data extends ActiveRecord
{
    public $user_data;

    public static function TableName()
    {
        return 'user_data';
    }

    public function rules()
    {
        return [
			[['id', 'id_user', 'donate'], 'integer'],
            [['city', 'position'], 'string', 'max' => 255],
            [['school', 'image'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'ID пользователя',
			'image' => 'Изображение профиля',
			'city' => 'Город',
			'position' => 'Должность',
			'school' => 'Школа',
            'donate' => 'Донат',
        ];
    }
}