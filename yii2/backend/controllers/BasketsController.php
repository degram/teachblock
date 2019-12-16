<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Orders;
use common\models\Product;
use common\models\Baskets;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class BasketsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','update','delete','add_product_basket'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionDelete($id,$id_order)
    {
        $model = Baskets::findOne($id);
		$model->delete();
		Orders::recalculationFullPriceOrder($id_order);
        return $this->redirect(['orders/update','id'=>$id_order]);
    }
	
	
	public function actionAdd_product_basket($id,$id_order)
	{
		if(!Baskets::findOne(['id_order'=>$id_order,'id_product'=>$id]))
		{
			if($model_poduct = Product::findOne($id))
			{
				$model_basket = new Baskets();
				$model_basket->id_order = $id_order;
				$model_basket->id_product = $model_poduct->id;
				$model_basket->price = $model_poduct->price;
				$model_basket->once_price = $model_poduct->price;
				$model_basket->amount = 1;
				if(!$model_basket->save())
				{
					print_r($model_basket->getErrors()); exit;
				}
				Orders::recalculationFullPriceOrder($id_order);
			}
			return $this->redirect(['/orders/update','id'=>$id_order]);
		}
		return $this->redirect(['/orders/update','id'=>$id_order]);
	}
}
