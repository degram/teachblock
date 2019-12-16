<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Post extends \yii\db\ActiveRecord
{

    public static function TableName()
    {
        return '{{post}}';
    }
	
	public function rules()
    {
        return [
			[['id' ,'active', 'count_view', 'id_category', 'id_user'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['text'], 'string'],
			[['little_text'], 'string', 'max' => 255],
			[['date_time'], 'date'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'id_user' => 'Автор',
            'title' => 'Заголовок новости',
			'text' => 'Новость',
			'little_text' => 'Краткое описание',
            'active' => 'Состояние активности',
			'date_time' => 'Дата',
			'count_view' => 'Просмотры',
			'id_category' => 'Категория'
        ];
    }
	
	public function processCountViewPost()
    {
        $session = Yii::$app->session;
        if (!isset($session['blog_post_view'])) {
            $session->set('blog_post_view', [$this->id]);
            $this->updateCounters(['count_view' => 1]);
        } else {
            if (!ArrayHelper::isIn($this->id, $session['blog_post_view'])) {
                $array = $session['blog_post_view'];
                array_push($array, $this->id);
                $session->remove('blog_post_view');
                $session->set('blog_post_view', $array);
                $this->updateCounters(['count_view' => 1]);
            }
        }
        return true;
    }
	
	
}