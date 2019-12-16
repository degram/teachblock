<?php
namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\Product; 

class SearchProduct extends Product
{
    public function search($name) 
	{
        $query = Product::find()->andWhere(['LIKE','name',$name]);
		return $query;
    }
	
	public function searchArray($name) 
	{
        $query = ArrayHelper::map(Product::find()->andWhere(['LIKE','name',$name])->asArray()->all(),'id','id');
		return $query;
    }
}