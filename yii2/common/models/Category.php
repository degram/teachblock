<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Category extends \yii\db\ActiveRecord
{

    public static function TableName()
    {
        return 'category';
    }
	
	public function rules()
    {
        return [
			[['id'],'integer'],
            [['name'], 'string', 'max' => 255],
            
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название категории',
			
        ];
    }
	
	
}