<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\imagine\Image;
use common\models\Baskets;

class Actions extends \yii\db\ActiveRecord
{
	public $image_file;
	public $image_file_logo;
    public static function TableName()
    {
        return '{{sht_action}}';
    }

    public function rules()
    {
        return [
			[['image_file'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['image'], 'string', 'max' => 255],
            [['active'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_file' => 'Главное изображение',
            'active' => 'Активность акции',
            'image' => 'Изображение',
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
                $image = time() . $image_file->name;
                $this->image = $image;
                if ($this->validate())
				{
					$uploaded = $image_file->saveAs($dir . $image);
                    Image::thumbnail(Yii::getAlias($dir . $image),1360, 473)->save(Yii::getAlias($dir . $image), ['quality' => 80]);
                }
			}
			return true;
		}
		return false;
	}

    public static function getActionObjectID($id_action)
    {
        return Actions::findOne($id_action);
    }
}