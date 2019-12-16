<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;  
use Imagine\Image\Box;

class Course extends \yii\db\ActiveRecord
{
    public $course;
	public $images;
	public $password;

    public static function TableName()
    {
        return 'course';
    }

    public function rules()
    {
        return [
			[['id', 'active', 'id_user'], 'integer'],
			[['little_text', 'name', 'image', 'little_name', 'class'], 'string', 'max' => 255],
			[['password'], 'string', 'max' => 255],
			[['addtime'], 'datetime'],
			[['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название курса',
			'id_user' => 'Создатель курса',
			'little_name' => 'Короткое имя курса',
			'little_text' => 'Краткое описание курса',
			'class' => 'Номер группы / класса',
			'image' => 'Изображение курса',
			'password' => 'Пароль курса',
			'addtime' => 'Дата создания курса',
            'active' => 'Состояние активности',
        ];
    }
	
	public function upload(){
		if($this->validate()){
			$this->images->saveAs('uploads/' . $this->images->baseName . '.' . $this->images->extension);
			Image::thumbnail('uploads/'.$this->images->baseName . '.' . $this->images->extension, 230, 153)
			->save(Yii::getAlias('uploads/'.$this->images->baseName . '.' . $this->images->extension), ['quality' => 100]);
			\Yii::$app->db->createCommand()
              ->update('course', ['image' =>'uploads/'.$this->images],['id'=>Yii::$app->db->getLastInsertId()])
              ->execute();
			return true;
		}
		else{
			return false;
		}
	}
}