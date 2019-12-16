<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\imagine\Image;
use common\models\Baskets;

class Product extends \yii\db\ActiveRecord
{
	public $image_file;
    public static function TableName()
    {
        return '{{yii_product}}';
    }

    public function rules()
    {
        return [
			[['image_file'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['name'], 'string', 'max' => 150],
            [['description','image','url'], 'string', 'max' => 255],
            [['weight', 'price', 'active'], 'integer'],
            [['consist'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название товара',
            'price' => 'Цена',
            'image_file' => 'Изображение',
            'image' => 'Изображение',
            'weight' => 'Вес',
            'active' => 'Наличие товара',
            'description' => 'Описание товара',
            'consist' => 'Состав',
            'url' => 'url',
        ];
    }

	public function beforeSave($insert) 
	{
		if (parent::beforeSave($insert)) 
		{
            $dir = Yii::getAlias('@frontend/web/uploads/items/');
            $image_file = UploadedFile::getInstance($this, 'image_file');
            if(empty($this->url) || trim($this->url)=='') 
			{
                $this->url = $this->translitIt();
            }
            
            if (isset($image_file->name) && trim($image_file->name) != '') 
			{
				
                $new_detail = time() . $image_file->name;
                $small_image = $new_detail;
                $catalog_image = 'resize_'.$new_detail;
                $this->image = $small_image;
                $this->image = $new_detail;
                if ($this->validate()) 
				{
					$uploaded = $image_file->saveAs($dir . $new_detail);
                    Image::thumbnail(Yii::getAlias($dir . $new_detail),2000, 2000)->save(Yii::getAlias($dir . $small_image), ['quality' => 50]);
                    Image::thumbnail(Yii::getAlias($dir . $new_detail),460, 300)->save(Yii::getAlias($dir . $catalog_image), ['quality' => 50]);
                }
			}
			return true;
		}
		return false;
	}

	private function translitIt()
    {
        $tr = [
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
            "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
            "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
            "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
            "У"=>"U","Ф"=>"F","І"=>'I',"і"=>"I",'ї'=>'j',"Х"=>"H","Ц"=>"TS","Ч"=>"CH",
            "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
            "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d",'є'=>'e',"е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"",
            "ы"=>"yi","і"=>"i","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
            " "=> "_","+"=>"_plus_","!"=>"_i_","%20"=>"_","Ё"=>"IO","ё"=>"io", '‘'=>'','\''=>'',
            ","=>'', "."=>'', "?" => '','('=>'',')'=>'','%'=>'','"'=>'','/'=>'',
        ];

        return substr(strtolower(strtr($this->name,$tr)), 0,50);
    }
	
	public static function getProduct($id_product)
	{
		return Product::findOne($id_product);
	}
	public static function getProductObject($id_product)
	{
		return Product::findOne($id_product);
	}
	
	public function setFullPriceOrder($id_order)
	{
		$model_basket = Baskets::find()->where(['id_order'=>$id_order])->asArray()->all();
		if($model_basket)
		{
			$full_price = 0;
			foreach($model_basket as $basket)
			{
				$full_price += $basket->price;
			}
			$model_order = Orders::findOne($id_order);
			if($model_order)
			{
				$model_order->full_price = $full_price;
				if(!$model_order->save())
				{
					print_r($model_order->getErrors()); exit;
				}
			}
		}
	}
	
	public static function getProductObjectID($id_product)
	{
		return Product::findOne($id_product);
	}
	
	public static function getWeightProduct($id_product)
	{
		if($product = self::getProductObjectID($id_product))
		{
			return $product->weight;
		}
		return '0';
	}
	
	public function getProductsForCategoryOneID($id_category,$id_product)
	{
		$model_products = Product::find()->leftJoin('yii_relations_product_category as relations','relations.id_product = yii_product.id')
		->where(['yii_product.active'=>1,'relations.id_category'=>$id_category])->andWhere(['!=','yii_product.id',$id_product])->all();
		return $model_products;
	}
}