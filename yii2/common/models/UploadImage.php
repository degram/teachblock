<?php
 
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;  
use Imagine\Image\Box;  
use common\models\User;
use common\models\Course;
 
class UploadImage extends Model{
 
    public $image;
 
    public function rules(){
        return[
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
 
	public function upload(){
		if($this->validate()){
			$this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
			Image::thumbnail('uploads/'.$this->image->baseName . '.' . $this->image->extension, 200, 200)
			->save(Yii::getAlias('uploads/'.$this->image->baseName . '.' . $this->image->extension), ['quality' => 100]);
			\Yii::$app->db->createCommand()
              ->update('user_data', ['image' =>'uploads/'.$this->image],['id'=>Yii::$app->user->id])
              ->execute();
			return true;
		}
		else{
			return false;
		}
	}
	public function uploadcourse(){
		if($this->validate()){
			$this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
			Image::thumbnail('uploads/'.$this->image->baseName . '.' . $this->image->extension, 200, 200)
			->save(Yii::getAlias('uploads/'.$this->image->baseName . '.' . $this->image->extension), ['quality' => 100]);
			\Yii::$app->db->createCommand()
              ->update('course', ['image' =>'uploads/'.$this->image],['id_user'=>Yii::$app->user->id])
              ->execute();
			return true;
		}
		else{
			return false;
		}
	}
 
}