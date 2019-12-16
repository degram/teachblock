<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\imagine\Image;
use common\models\Baskets;

class Options extends \yii\db\ActiveRecord
{
	public $image_file;
	public $image_file_logo;
    public static function TableName()
    {
        return '{{yii_options}}';
    }

    public function rules()
    {
        return [
			[['image_file'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
			[['image_file_logo'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['phone'], 'string', 'max' => 30],
            [['time_work'], 'string', 'max' => 150],
            [['promo','email'], 'string', 'max' => 50],
            [['promo_text','image_header','footer_cript','cor_1','cor_2','image_logo'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_file' => 'Главное изображение',
            'image_header' => 'Главное изображение',
            'phone' => 'Номер телефона',
            'time_work' => 'Время работы',
            'promo' => 'Заголовок на изображении',
            'promo_text' => 'Основная информация на изображении',
            'email' => 'Эл. почта',
            'image_logo' => 'Изображение Logo',
            'image_file_logo' => 'Изображение Logo',
            'footer_cript' => 'Текст в нижнем блоке сайта',
            'cor_1' => 'url "Условия доставки"',
            'cor_2' => 'url "Условия использования ПС"',
        ];
    }
	
	public function beforeSave($insert) 
	{
		if (parent::beforeSave($insert)) 
		{
            $dir = Yii::getAlias('@frontend/web/site/');
            $image_file = UploadedFile::getInstance($this, 'image_file');
			if (isset($image_file->name) && trim($image_file->name) != '') 
			{
                $image_header = time() . $image_file->name;
                $this->image_header = $image_header;
                if ($this->validate()) 
				{
					$uploaded = $image_file->saveAs($dir . $image_header);
                    Image::thumbnail(Yii::getAlias($dir . $image_header),2000, 2000)->save(Yii::getAlias($dir . $image_header), ['quality' => 80]);
                }
			}
			$image_file_logo = UploadedFile::getInstance($this, 'image_file_logo');
			if (isset($image_file_logo->name) && trim($image_file_logo->name) != '') 
			{
                $image_logo = time() . $image_file_logo->name;
                $this->image_logo = $image_logo;
                if ($this->validate()) 
				{
					$uploaded = $image_file_logo->saveAs($dir . $image_logo);
                    Image::thumbnail(Yii::getAlias($dir . $image_logo),80, 80)->save(Yii::getAlias($dir . $image_logo), ['quality' => 80]);
                }
			}
			return true;
		}
		return false;
	}
	
	public static function getOptionsObject()
	{
		return Options::findOne(1);
	}
}