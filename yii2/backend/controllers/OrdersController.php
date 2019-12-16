<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\SearchProduct;
use common\models\Orders;
use common\models\Product;
use common\models\Baskets;
use common\models\StatusOrder;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class OrdersController extends Controller
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
                        'actions' => ['index','update','add_product_for_order','delete'],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Orders::find(),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
	
	public function actionUpdate($id)
    {
        $model_orders = Orders::findOne($id);
        $model_basket = new Baskets();
        $model_status_order = new StatusOrder();
		$dataProvider = new ActiveDataProvider([
            'query' => Baskets::find()->where(['id_order'=>$id]),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
		
		
		if ($model_orders->load(Yii::$app->request->post())) 
		{
			if($postData = Yii::$app->request->post('Amount'))
			{
				if($full_price = $model_basket->setAmountPriceBasketData($postData))
				{
					if($full_price!=0)
					{
						$model_orders->full_price = $full_price;
					}
				}
			}
			$model_orders->save();
            return $this->redirect(['orders/index']);
        }
        return $this->render('update',
			[
				'model_status_order'=>$model_status_order,
				'model'=>$model_orders,
				'id_order'=>$id,
				'dataProvider'=>$dataProvider,
			]
		);
    }
	
    public function actionDelete($id)
    {
        $model = Orders::findOne($id);
		$model->status = 2;
		if(!$model->save())
		{
			print_r($model->getErrors()); exit;
		}
        return $this->redirect(['orders/index']);
    }
	
	public function actionAdd_product_for_order($id_order)
	{
		$model = new SearchProduct();
		
		if($post = yii::$app->request->post('SearchProduct')) : 
			$query = $model->search($post['name']); 
			$model->name = $post['name'];
			$dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
		endif;
		
		return $this->render('add_product_for_order',
		[
			'post' => $post,
			'model' => $model,
			'dataProvider' => $dataProvider,
			'id_order' => $id_order,
		]);
	}
}
