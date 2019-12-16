<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Notification extends \yii\db\ActiveRecord
{

    public static function TableName()
    {
        return 'user_notif';
    }
	
	public function rules()
    {
        return [
			[['id'], ['id_user'], ['id_course'], ['active'], ['id_notif'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'id_user' => 'Пользоватеть',
			'id_course' => 'Курс',
			'id_notif' => 'Идентификатор уведомления',
			'active' => 'Активность',
        ];
    }

}