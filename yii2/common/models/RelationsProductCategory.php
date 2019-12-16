<?php
namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\Category;

class RelationsProductCategory extends \yii\db\ActiveRecord
{
    public $country;

    public static function TableName()
    {
        return '{{yii_relations_product_category}}';
    }

    public function rules()
    {
        return [
            [['id_category'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'id_product' => 'id product',
            'id_category' => 'id category'
        ];
    }
	
	public static function setRelationsProductCategory($id_product,$relations__list)
	{
		RelationsProductCategory::deleteAll(['id_product'=>$id_product]);
		if($relations__list)
		{
			foreach($relations__list as $id => $status)
			{
				$model_relations = new RelationsProductCategory();
				$model_relations->id_category = $id;
				$model_relations->id_product = $id_product;
				if(!$model_relations->save())
				{
					print_r($model_relations->getErrors()); exit;
				}
			}
			return true;
		}
		return true;
	}
	
	public static function getAllRelationsProduct($id_product)
	{
		return ArrayHelper::map(RelationsProductCategory::find()->where(['id_product'=>$id_product])->asArray()->all(),'id_category','id_category');
	}
	
	public function getCategoryFrom_IDProduct($id_product)
	{
		$model_relations = RelationsProductCategory::find()->where(['id_product'=>$id_product])->orderBy('rand()')->one();
		if($model_relations)
		{
			return Category::findOne($model_relations->id_category);
		}
		return false;
	}
}